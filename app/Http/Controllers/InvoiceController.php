<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\JcTable;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('invoice_number', 'like', "%{$search}%");
            });
        }

        $invoices = $query->orderByDesc('created_at')->paginate(15)->appends($request->all());

        $stats = [
            'total' => Invoice::count(),
            'outstanding' => Invoice::whereIn('status', ['sent', 'overdue'])->sum('total'),
            'paidThisMonth' => Invoice::where('status', 'paid')
                ->whereMonth('updated_at', now()->month)
                ->whereYear('updated_at', now()->year)
                ->sum('total'),
            'draftCount' => Invoice::where('status', 'draft')->count(),
        ];

        return view('admin.invoices.index', compact('invoices', 'stats'));
    }

    public function create()
    {
        $invoice = new Invoice([
            'issue_date' => now()->toDateString(),
            'currency' => 'KES',
        ]);

        return view('admin.invoices.create', compact('invoice'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateInvoice($request);

        $invoice = DB::transaction(function () use ($validated, $request) {
            $invoice = Invoice::create([
                'user_id' => $request->user()->id,
                'client_name' => $validated['client_name'],
                'client_email' => $validated['client_email'],
                'client_phone' => $validated['client_phone'] ?? null,
                'client_address' => $validated['client_address'] ?? null,
                'issue_date' => $validated['issue_date'],
                'due_date' => $validated['due_date'] ?? null,
                'currency' => $validated['currency'] ?? 'KES',
                'tax_rate' => $validated['tax_rate'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            $this->syncItems($invoice, $validated['items']);
            $invoice->recalculateTotals();

            return $invoice;
        });

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Invoice raised successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('items');

        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('items');

        return view('admin.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $this->validateInvoice($request);

        DB::transaction(function () use ($validated, $invoice, $request) {
            $invoice->update([
                'client_name' => $validated['client_name'],
                'client_email' => $validated['client_email'],
                'client_phone' => $validated['client_phone'] ?? null,
                'client_address' => $validated['client_address'] ?? null,
                'issue_date' => $validated['issue_date'],
                'due_date' => $validated['due_date'] ?? null,
                'currency' => $validated['currency'] ?? 'KES',
                'status' => $validated['status'] ?? $invoice->status,
                'tax_rate' => $validated['tax_rate'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            $invoice->items()->delete();
            $this->syncItems($invoice, $validated['items']);
            $invoice->recalculateTotals();
        });

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load('items');

        $pdf = Pdf::loadView('invoices.pdf', ['invoice' => $invoice])
            ->setPaper('a4', 'portrait');

        return $pdf->download("{$invoice->invoice_number}.pdf");
    }

    public function downloadWord(Invoice $invoice)
    {
        $invoice->load('items');

        $phpWord = $this->buildInvoiceWord($invoice);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $temp = tempnam(sys_get_temp_dir(), 'inv_');
        $writer->save($temp);

        return response()->download($temp, "{$invoice->invoice_number}.docx", [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend();
    }

    public function send(Invoice $invoice)
    {
        $invoice->load('items');

        $pdfBinary = Pdf::loadView('invoices.pdf', ['invoice' => $invoice])
            ->setPaper('a4', 'portrait')
            ->output();

        Mail::to($invoice->client_email)->send(new InvoiceMail($invoice, $pdfBinary));

        if ($invoice->status === 'draft') {
            $invoice->status = 'sent';
        }
        $invoice->sent_at = now();
        $invoice->save();

        return redirect()->route('invoices.show', $invoice)
            ->with('success', "Invoice emailed to {$invoice->client_email}.");
    }

    private function validateInvoice(Request $request): array
    {
        return $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'nullable|string|max:50',
            'client_address' => 'nullable|string',
            'issue_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:issue_date',
            'currency' => 'nullable|string|max:8',
            'status' => 'nullable|in:draft,sent,paid,overdue,cancelled',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);
    }

    private function syncItems(Invoice $invoice, array $items): void
    {
        foreach (array_values($items) as $index => $item) {
            $invoice->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'amount' => round($item['quantity'] * $item['unit_price'], 2),
                'sort_order' => $index,
            ]);
        }
    }

    // ── WORD (.docx) EXPORT ─────────────────────────────────────────────
    // Editable invoice document, branded to match invoices.pdf / letterheads/design1.

    private function buildInvoiceWord(Invoice $invoice): PhpWord
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(10);

        $txtW = Converter::cmToTwip(17);

        $section = $phpWord->addSection([
            'pageSizeW' => Converter::cmToTwip(21),
            'pageSizeH' => Converter::cmToTwip(29.7),
            'marginTop' => 0,
            'marginBottom' => Converter::cmToTwip(1.5),
            'marginLeft' => Converter::cmToTwip(2),
            'marginRight' => Converter::cmToTwip(2),
            'headerHeight' => Converter::cmToTwip(3.6),
            'footerHeight' => Converter::cmToTwip(0.9),
        ]);

        // ── Header: navy bar (logo + company name) ──
        $header = $section->addHeader();

        $phpWord->addTableStyle('INV_Nav', $this->flatTable('1f3b73'));
        $navRow = $header->addTable('INV_Nav');
        $navRow->addRow(Converter::cmToTwip(2.2));

        $navRow->addCell(Converter::cmToTwip(5.5), $this->cell('1f3b73'))
            ->addImage(public_path('images/logo-footer.png'), ['width' => 95, 'height' => 47]);

        $nc = $navRow->addCell(Converter::cmToTwip(11.5), $this->cell('1f3b73', 'center'));
        $nc->addText('Taxgen Consultants LLP',
            ['name' => 'Georgia', 'size' => 17, 'bold' => true, 'color' => 'FFFFFF'],
            ['alignment' => 'right', 'spaceAfter' => 0, 'spaceBefore' => 0]
        );
        $nc->addText('TAX   ·   ACCOUNTING   ·   FINANCIAL ADVISORY',
            ['name' => 'Arial', 'size' => 7, 'color' => 'e25822'],
            ['alignment' => 'right', 'spaceAfter' => 0, 'spaceBefore' => 60]
        );

        // Orange contact strip
        $phpWord->addTableStyle('INV_Strip', $this->flatTable('e25822'));
        $strip = $header->addTable('INV_Strip');
        $strip->addRow(Converter::cmToTwip(0.65));

        $strip->addCell(Converter::cmToTwip(7), $this->cell('e25822'))
            ->addText('Trio Complex, Ground Floor, Garden Estate, Nairobi',
                ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'], ['spaceAfter' => 0, 'spaceBefore' => 0]);
        $strip->addCell(Converter::cmToTwip(4), $this->cell('e25822', 'center'))
            ->addText('(+254) 723-881-440',
                ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'],
                ['alignment' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
        $strip->addCell(Converter::cmToTwip(6), $this->cell('e25822'))
            ->addText('info@taxgenconsulting.com',
                ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'],
                ['alignment' => 'right', 'spaceAfter' => 0, 'spaceBefore' => 0]);

        // ── Body: bill-to + invoice meta ──
        $phpWord->addTableStyle('INV_Meta', ['borderSize' => 0, 'borderColor' => 'FFFFFF', 'cellMarginTop' => 0, 'cellMarginBottom' => 0]);
        $meta = $section->addTable('INV_Meta');
        $meta->addRow();

        $billTo = $meta->addCell(Converter::cmToTwip(10), ['valign' => 'top']);
        $billTo->addText('BILL TO', ['name' => 'Arial', 'size' => 8, 'color' => '777777'], ['spaceBefore' => 200, 'spaceAfter' => 40]);
        $billTo->addText($invoice->client_name, ['name' => 'Arial', 'size' => 12, 'bold' => true, 'color' => '1f3b73'], ['spaceAfter' => 20]);
        if ($invoice->client_address) {
            $billTo->addText($invoice->client_address, ['name' => 'Arial', 'size' => 9, 'color' => '555555'], ['spaceAfter' => 20]);
        }
        $billTo->addText($invoice->client_email, ['name' => 'Arial', 'size' => 9, 'color' => '555555'], ['spaceAfter' => 0]);
        if ($invoice->client_phone) {
            $billTo->addText($invoice->client_phone, ['name' => 'Arial', 'size' => 9, 'color' => '555555'], ['spaceAfter' => 0]);
        }

        $metaCell = $meta->addCell(Converter::cmToTwip(7), ['valign' => 'top']);
        $metaCell->addText('INVOICE', ['name' => 'Arial', 'size' => 15, 'bold' => true, 'color' => '1f3b73'],
            ['alignment' => 'right', 'spaceBefore' => 200, 'spaceAfter' => 60]);
        $metaCell->addText('Invoice #: ' . $invoice->invoice_number, ['name' => 'Arial', 'size' => 9, 'color' => '333333'],
            ['alignment' => 'right', 'spaceAfter' => 20]);
        $metaCell->addText('Date: ' . $invoice->issue_date->format('d F Y'), ['name' => 'Arial', 'size' => 9, 'color' => '333333'],
            ['alignment' => 'right', 'spaceAfter' => 20]);
        if ($invoice->due_date) {
            $metaCell->addText('Due: ' . $invoice->due_date->format('d F Y'), ['name' => 'Arial', 'size' => 9, 'color' => '333333'],
                ['alignment' => 'right', 'spaceAfter' => 0]);
        }

        $section->addTextBreak(1);

        // ── Items table ──
        $phpWord->addTableStyle('INV_Items', [
            'borderSize' => 4, 'borderColor' => 'EEEEEE', 'cellMargin' => 80,
        ]);
        $items = $section->addTable('INV_Items');

        $items->addRow(Converter::cmToTwip(0.7), ['tblHeader' => true]);
        $headerCellStyle = $this->cell('1f3b73');
        $items->addCell(Converter::cmToTwip(8.5), $headerCellStyle)
            ->addText('Description', ['name' => 'Arial', 'size' => 8, 'bold' => true, 'color' => 'FFFFFF'], ['spaceAfter' => 0]);
        $items->addCell(Converter::cmToTwip(2), $headerCellStyle)
            ->addText('Qty', ['name' => 'Arial', 'size' => 8, 'bold' => true, 'color' => 'FFFFFF'], ['alignment' => 'right', 'spaceAfter' => 0]);
        $items->addCell(Converter::cmToTwip(3.25), $headerCellStyle)
            ->addText('Unit Price', ['name' => 'Arial', 'size' => 8, 'bold' => true, 'color' => 'FFFFFF'], ['alignment' => 'right', 'spaceAfter' => 0]);
        $items->addCell(Converter::cmToTwip(3.25), $headerCellStyle)
            ->addText('Amount', ['name' => 'Arial', 'size' => 8, 'bold' => true, 'color' => 'FFFFFF'], ['alignment' => 'right', 'spaceAfter' => 0]);

        foreach ($invoice->items as $item) {
            $items->addRow();
            $items->addCell(Converter::cmToTwip(8.5))
                ->addText($item->description, ['name' => 'Arial', 'size' => 9], ['spaceAfter' => 0]);
            $items->addCell(Converter::cmToTwip(2))
                ->addText(rtrim(rtrim(number_format((float) $item->quantity, 2), '0'), '.'), ['name' => 'Arial', 'size' => 9], ['alignment' => 'right', 'spaceAfter' => 0]);
            $items->addCell(Converter::cmToTwip(3.25))
                ->addText(number_format((float) $item->unit_price, 2), ['name' => 'Arial', 'size' => 9], ['alignment' => 'right', 'spaceAfter' => 0]);
            $items->addCell(Converter::cmToTwip(3.25))
                ->addText(number_format((float) $item->amount, 2), ['name' => 'Arial', 'size' => 9], ['alignment' => 'right', 'spaceAfter' => 0]);
        }

        $section->addTextBreak(1);

        // ── Totals ──
        $phpWord->addTableStyle('INV_Totals', ['borderSize' => 0, 'borderColor' => 'FFFFFF', 'alignment' => JcTable::END]);
        $totals = $section->addTable('INV_Totals');

        $totals->addRow();
        $totals->addCell(Converter::cmToTwip(4.5))
            ->addText('Subtotal', ['name' => 'Arial', 'size' => 9, 'color' => '555555'], ['alignment' => 'right', 'spaceAfter' => 0]);
        $totals->addCell(Converter::cmToTwip(3.5))
            ->addText($invoice->currency . ' ' . number_format((float) $invoice->subtotal, 2), ['name' => 'Arial', 'size' => 9], ['alignment' => 'right', 'spaceAfter' => 0]);

        if ($invoice->tax_rate) {
            $taxLabel = 'Tax (' . rtrim(rtrim(number_format((float) $invoice->tax_rate, 2), '0'), '.') . '%)';
            $totals->addRow();
            $totals->addCell(Converter::cmToTwip(4.5))
                ->addText($taxLabel, ['name' => 'Arial', 'size' => 9, 'color' => '555555'], ['alignment' => 'right', 'spaceAfter' => 0]);
            $totals->addCell(Converter::cmToTwip(3.5))
                ->addText($invoice->currency . ' ' . number_format((float) $invoice->tax_amount, 2), ['name' => 'Arial', 'size' => 9], ['alignment' => 'right', 'spaceAfter' => 0]);
        }

        $totals->addRow();
        $totals->addCell(Converter::cmToTwip(4.5), ['bgColor' => '1f3b73'])
            ->addText('Total', ['name' => 'Arial', 'size' => 10, 'bold' => true, 'color' => 'FFFFFF'], ['alignment' => 'right', 'spaceAfter' => 0]);
        $totals->addCell(Converter::cmToTwip(3.5), ['bgColor' => '1f3b73'])
            ->addText($invoice->currency . ' ' . number_format((float) $invoice->total, 2), ['name' => 'Arial', 'size' => 10, 'bold' => true, 'color' => 'FFFFFF'], ['alignment' => 'right', 'spaceAfter' => 0]);

        if ($invoice->notes) {
            $section->addTextBreak(1);
            $section->addText('NOTES', ['name' => 'Arial', 'size' => 8, 'color' => '777777'], ['spaceAfter' => 40]);
            $section->addText($invoice->notes, ['name' => 'Arial', 'size' => 9, 'color' => '555555'], ['spaceAfter' => 0]);
        }

        // ── Footer ──
        $footer = $section->addFooter();
        $phpWord->addTableStyle('INV_Ft', $this->flatTable('1f3b73'));
        $ft = $footer->addTable('INV_Ft');
        $ft->addRow(Converter::cmToTwip(0.7));

        $ft->addCell(Converter::cmToTwip(7), $this->cell('1f3b73'))
            ->addText('P.O. Box 78930-00620, Mobile Plaza, Nairobi',
                ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'], ['spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(4), $this->cell('1f3b73', 'center'))
            ->addText('Taxgen Consultants LLP',
                ['name' => 'Arial', 'size' => 9, 'bold' => true, 'color' => 'e25822'],
                ['alignment' => 'center', 'spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(6), $this->cell('1f3b73'))
            ->addText('Thank you for your business',
                ['name' => 'Arial', 'size' => 8, 'color' => 'AAAAAA'],
                ['alignment' => 'right', 'spaceAfter' => 0]);

        return $phpWord;
    }

    private function flatTable(string $bg): array
    {
        return [
            'bgColor' => $bg,
            'borderSize' => 0,
            'borderColor' => $bg,
            'cellMarginTop' => Converter::cmToTwip(0.2),
            'cellMarginBottom' => Converter::cmToTwip(0.2),
            'cellMarginLeft' => Converter::cmToTwip(0.3),
            'cellMarginRight' => Converter::cmToTwip(0.3),
        ];
    }

    private function cell(?string $bg = null, string $valign = 'center'): array
    {
        $style = ['valign' => $valign];
        if ($bg) {
            $style['bgColor'] = $bg;
        }

        return $style;
    }
}
