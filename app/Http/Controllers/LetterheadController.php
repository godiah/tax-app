<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;

class LetterheadController extends Controller
{
    private array $designs = [
        1 => ['name' => 'Classic Navy',   'desc' => 'Traditional navy header with orange contact strip'],
        2 => ['name' => 'Modern Minimal', 'desc' => 'Clean white with accent borders and gradient divider'],
        3 => ['name' => 'Bold Executive', 'desc' => 'Split sidebar with dark navy panel and bold typography'],
    ];

    public function preview()
    {
        return view('letterheads.preview', ['designs' => $this->designs]);
    }

    public function show(int $design)
    {
        abort_unless(isset($this->designs[$design]), 404);

        // Browser needs a URL; PDF needs a file path (set in viewData)
        return view("letterheads.design{$design}", array_merge($this->viewData(), [
            'logo' => asset('images/logo-footer.png'),
        ]));
    }

    public function downloadPdf(int $design)
    {
        abort_unless(isset($this->designs[$design]), 404);

        $pdf = Pdf::loadView("letterheads.design{$design}", $this->viewData())
            ->setPaper('a4', 'portrait');

        return $pdf->download('taxgen-letterhead-design' . $design . '-' . now()->format('Ymd') . '.pdf');
    }

    public function downloadWord(int $design)
    {
        abort_unless(isset($this->designs[$design]), 404);

        $phpWord = match ($design) {
            1 => $this->buildWord1(),
            2 => $this->buildWord2(),
            3 => $this->buildWord3(),
        };

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $temp   = tempnam(sys_get_temp_dir(), 'lh_');
        $writer->save($temp);

        $filename = 'taxgen-letterhead-design' . $design . '.docx';

        return response()->download($temp, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend();
    }

    // ── DESIGN 1: Classic Navy ────────────────────────────────────────────

    private function buildWord1(): PhpWord
    {
        $phpWord = $this->baseWord();

        // A4, 2 cm left/right margins, zero top so header bleeds to edge
        $tw   = Converter::cmToTwip(21);
        $txtW = Converter::cmToTwip(17);

        $section = $phpWord->addSection([
            'pageSizeW'    => $tw,
            'pageSizeH'    => Converter::cmToTwip(29.7),
            'marginTop'    => 0,
            'marginBottom' => Converter::cmToTwip(1.5),
            'marginLeft'   => Converter::cmToTwip(2),
            'marginRight'  => Converter::cmToTwip(2),
            'headerHeight' => Converter::cmToTwip(3.6),
            'footerHeight' => Converter::cmToTwip(0.9),
        ]);

        // ── Header ──
        $header = $section->addHeader();

        // Row 1: navy bar — logo left, company name right
        $phpWord->addTableStyle('D1_Nav', $this->flatTable('1f3b73'));
        $navRow = $header->addTable('D1_Nav');
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

        // Row 2: orange contact strip
        $phpWord->addTableStyle('D1_Strip', $this->flatTable('e25822'));
        $strip = $header->addTable('D1_Strip');
        $strip->addRow(Converter::cmToTwip(0.65));

        $strip->addCell(Converter::cmToTwip(7), $this->cell('e25822'))
              ->addText('Trio Complex, Off Exit 7, Thika Road, G-03, Nairobi',
                  ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'],
                  ['spaceAfter' => 0, 'spaceBefore' => 0]);

        $strip->addCell(Converter::cmToTwip(4), $this->cell('e25822', 'center'))
              ->addText('(+254) 723-881-440',
                  ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'],
                  ['alignment' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

        $strip->addCell(Converter::cmToTwip(6), $this->cell('e25822'))
              ->addText('info@taxgenconsulting.com',
                  ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'],
                  ['alignment' => 'right', 'spaceAfter' => 0, 'spaceBefore' => 0]);

        // ── Body ──
        $this->addBodyContent($section);

        // ── Footer ──
        $footer = $section->addFooter();
        $phpWord->addTableStyle('D1_Ft', $this->flatTable('1f3b73'));
        $ft = $footer->addTable('D1_Ft');
        $ft->addRow(Converter::cmToTwip(0.7));

        $ft->addCell(Converter::cmToTwip(7), $this->cell('1f3b73'))
           ->addText('P.O. Box 78930-00620, Mobile Plaza, Nairobi',
               ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'], ['spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(4), $this->cell('1f3b73', 'center'))
           ->addText('Taxgen Consultants LLP',
               ['name' => 'Arial', 'size' => 9, 'bold' => true, 'color' => 'e25822'],
               ['alignment' => 'center', 'spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(6), $this->cell('1f3b73'))
           ->addText('Confidential — For addressee only',
               ['name' => 'Arial', 'size' => 8, 'color' => 'AAAAAA'],
               ['alignment' => 'right', 'spaceAfter' => 0]);

        return $phpWord;
    }

    // ── DESIGN 2: Modern Minimal ──────────────────────────────────────────

    private function buildWord2(): PhpWord
    {
        $phpWord = $this->baseWord();

        $tw   = Converter::cmToTwip(21);
        $txtW = Converter::cmToTwip(17);

        $section = $phpWord->addSection([
            'pageSizeW'    => $tw,
            'pageSizeH'    => Converter::cmToTwip(29.7),
            'marginTop'    => Converter::cmToTwip(0.3),
            'marginBottom' => Converter::cmToTwip(1.5),
            'marginLeft'   => Converter::cmToTwip(2),
            'marginRight'  => Converter::cmToTwip(2),
            'headerHeight' => Converter::cmToTwip(3.4),
            'footerHeight' => Converter::cmToTwip(1.1),
        ]);

        // ── Header ──
        $header = $section->addHeader();

        // Orange top bar
        $phpWord->addTableStyle('D2_TopBar', $this->flatTable('e25822', 0, 0, 0, 0));
        $topBar = $header->addTable('D2_TopBar');
        $topBar->addRow(Converter::cmToTwip(0.22));
        $topBar->addCell($txtW, $this->cell('e25822'))
               ->addText('', [], ['spaceAfter' => 0]);

        // Main header row: logo | brand | contacts
        $phpWord->addTableStyle('D2_Main', [
            'borderSize' => 0, 'borderColor' => 'FFFFFF',
            'cellMarginTop' => Converter::cmToTwip(0.3),
            'cellMarginBottom' => Converter::cmToTwip(0.2),
            'cellMarginLeft' => Converter::cmToTwip(0.15),
            'cellMarginRight' => Converter::cmToTwip(0.15),
        ]);
        $mt = $header->addTable('D2_Main');
        $mt->addRow(Converter::cmToTwip(2));

        $mt->addCell(Converter::cmToTwip(2.8), $this->cell(null, 'center'))
           ->addImage(public_path('images/logo-footer.png'), ['width' => 72, 'height' => 36]);

        $bc = $mt->addCell(Converter::cmToTwip(6.7), [
            'valign' => 'center',
            'borderLeftSize' => 10, 'borderLeftColor' => 'e0e0e0',
        ]);
        $bc->addText('Taxgen Consultants LLP',
            ['name' => 'Georgia', 'size' => 16, 'bold' => true, 'color' => '1f3b73'],
            ['spaceAfter' => 0, 'spaceBefore' => 0]
        );
        $bc->addText('TAX  ·  ACCOUNTING  ·  FINANCIAL ADVISORY',
            ['name' => 'Arial', 'size' => 7, 'color' => 'e25822'],
            ['spaceAfter' => 0, 'spaceBefore' => 60]
        );

        $cc = $mt->addCell(Converter::cmToTwip(7.5), $this->cell(null, 'center'));
        foreach ([
            ['Phone:', '(+254) 723-881-440'],
            ['Email:', 'info@taxgenconsulting.com'],
            ['Office:', 'Trio Complex, G-03, Thika Road'],
        ] as [$label, $val]) {
            $cc->addText($label . ' ' . $val,
                ['name' => 'Arial', 'size' => 8.5, 'color' => '555555'],
                ['alignment' => 'right', 'spaceAfter' => 20, 'spaceBefore' => 0]
            );
        }

        // Divider bar (navy)
        $phpWord->addTableStyle('D2_Div', $this->flatTable('1f3b73', 0, 0, 0, 0));
        $div = $header->addTable('D2_Div');
        $div->addRow(Converter::cmToTwip(0.1));
        $div->addCell($txtW, $this->cell('1f3b73'))
            ->addText('', [], ['spaceAfter' => 0]);

        // ── Body ──
        $this->addBodyContent($section);

        // ── Footer ──
        $footer = $section->addFooter();
        $phpWord->addTableStyle('D2_Ft', [
            'borderSize' => 0, 'borderColor' => 'FFFFFF',
            'cellMarginTop' => Converter::cmToTwip(0.1),
            'cellMarginBottom' => 0,
            'cellMarginLeft' => 0, 'cellMarginRight' => 0,
        ]);
        $ft = $footer->addTable('D2_Ft');
        $ft->addRow();
        $ft->addCell(Converter::cmToTwip(6))
           ->addText('P.O. Box 78930-00620, Nairobi',
               ['name' => 'Arial', 'size' => 8, 'color' => 'AAAAAA'], ['spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(5))
           ->addText('Taxgen Consultants LLP',
               ['name' => 'Arial', 'size' => 9, 'bold' => true, 'color' => '1f3b73'],
               ['alignment' => 'center', 'spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(6))
           ->addText('www.taxgenconsulting.com',
               ['name' => 'Arial', 'size' => 8, 'color' => 'AAAAAA'],
               ['alignment' => 'right', 'spaceAfter' => 0]);

        // Navy bottom bar
        $phpWord->addTableStyle('D2_FtBar', $this->flatTable('1f3b73', 0, 0, 0, 0));
        $fbar = $footer->addTable('D2_FtBar');
        $fbar->addRow(Converter::cmToTwip(0.22));
        $fbar->addCell($txtW, $this->cell('1f3b73'))
             ->addText('', [], ['spaceAfter' => 0]);

        return $phpWord;
    }

    // ── DESIGN 3: Bold Executive ──────────────────────────────────────────

    private function buildWord3(): PhpWord
    {
        $phpWord = $this->baseWord();

        $tw   = Converter::cmToTwip(21);
        $txtW = Converter::cmToTwip(17);

        $section = $phpWord->addSection([
            'pageSizeW'    => $tw,
            'pageSizeH'    => Converter::cmToTwip(29.7),
            'marginTop'    => 0,
            'marginBottom' => Converter::cmToTwip(1.5),
            'marginLeft'   => Converter::cmToTwip(2),
            'marginRight'  => Converter::cmToTwip(2),
            'headerHeight' => Converter::cmToTwip(4),
            'footerHeight' => Converter::cmToTwip(0.9),
        ]);

        // ── Header ──
        $header = $section->addHeader();

        // Orange top accent bar
        $phpWord->addTableStyle('D3_TopBar', $this->flatTable('e25822', 0, 0, 0, 0));
        $topBar = $header->addTable('D3_TopBar');
        $topBar->addRow(Converter::cmToTwip(0.35));
        $topBar->addCell($txtW, $this->cell('e25822'))
               ->addText('', [], ['spaceAfter' => 0]);

        // Split: dark navy left panel | light gray right panel
        $phpWord->addTableStyle('D3_Split', [
            'borderSize' => 0, 'borderColor' => 'FFFFFF',
            'cellMarginTop' => Converter::cmToTwip(0.3),
            'cellMarginBottom' => Converter::cmToTwip(0.3),
            'cellMarginLeft' => Converter::cmToTwip(0.4),
            'cellMarginRight' => Converter::cmToTwip(0.4),
        ]);
        $sp = $header->addTable('D3_Split');
        $sp->addRow(Converter::cmToTwip(3.1));

        $sp->addCell(Converter::cmToTwip(4.5), $this->cell('1a3060', 'center'))
           ->addImage(public_path('images/logo-footer.png'), [
               'width' => 88, 'height' => 44, 'alignment' => 'center',
           ]);

        $rc = $sp->addCell(Converter::cmToTwip(12.5), [
            'bgColor' => 'f7f8fc', 'valign' => 'center',
            'borderBottomSize' => 16, 'borderBottomColor' => '1f3b73',
        ]);
        $rc->addText('Taxgen Consultants LLP',
            ['name' => 'Georgia', 'size' => 18, 'bold' => true, 'color' => '1a3060'],
            ['spaceAfter' => 0, 'spaceBefore' => 0]
        );
        $rc->addText('TAX   ·   ACCOUNTING   ·   FINANCIAL ADVISORY',
            ['name' => 'Arial', 'size' => 7.5, 'color' => 'e25822', 'bold' => true],
            ['spaceAfter' => 100, 'spaceBefore' => 80]
        );
        foreach ([
            'Tel: (+254) 723-881-440',
            'Email: info@taxgenconsulting.com',
            'Office: Trio Complex, G-03, Thika Road',
        ] as $line) {
            $rc->addText($line,
                ['name' => 'Arial', 'size' => 8.5, 'color' => '555555'],
                ['spaceAfter' => 20, 'spaceBefore' => 0]
            );
        }

        // ── Body ──
        $this->addBodyContent($section);

        // ── Footer ──
        $footer = $section->addFooter();
        $phpWord->addTableStyle('D3_Ft', $this->flatTable('1a3060'));
        $ft = $footer->addTable('D3_Ft');
        $ft->addRow(Converter::cmToTwip(0.7));

        $ft->addCell(Converter::cmToTwip(7), $this->cell('1a3060'))
           ->addText('P.O. Box 78930-00620, Mobile Plaza, Nairobi',
               ['name' => 'Arial', 'size' => 8, 'color' => 'FFFFFF'], ['spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(4), $this->cell('1a3060', 'center'))
           ->addText('Taxgen Consultants LLP',
               ['name' => 'Arial', 'size' => 9, 'bold' => true, 'color' => 'FFFFFF'],
               ['alignment' => 'center', 'spaceAfter' => 0]);
        $ft->addCell(Converter::cmToTwip(6), $this->cell('1a3060'))
           ->addText('Confidential — For addressee only',
               ['name' => 'Arial', 'size' => 8, 'color' => 'AAAAAA'],
               ['alignment' => 'right', 'spaceAfter' => 0]);

        // Orange bottom bar
        $phpWord->addTableStyle('D3_FtBar', $this->flatTable('e25822', 0, 0, 0, 0));
        $fbar = $footer->addTable('D3_FtBar');
        $fbar->addRow(Converter::cmToTwip(0.25));
        $fbar->addCell($txtW, $this->cell('e25822'))
             ->addText('', [], ['spaceAfter' => 0]);

        return $phpWord;
    }

    // ── SHARED HELPERS ────────────────────────────────────────────────────

    private function addBodyContent(\PhpOffice\PhpWord\Element\Section $section): void
    {
        // Thin orange divider line
        $section->addText('',
            ['name' => 'Arial', 'size' => 4],
            ['spaceBefore' => 80, 'spaceAfter' => 160,
             'borderBottomSize' => 6, 'borderBottomColor' => 'e25822']
        );

        // Letter body placeholder
        $section->addText('Dear Sir / Madam,',
            ['name' => 'Arial', 'size' => 11],
            ['spaceBefore' => 240, 'spaceAfter' => 240]
        );
        $section->addText('(Type your message here...)',
            ['name' => 'Arial', 'size' => 11, 'color' => 'BBBBBB', 'italic' => true],
            ['spaceBefore' => 240, 'spaceAfter' => 960]
        );
        $section->addTextBreak(3);
        $section->addText('Yours faithfully,',
            ['name' => 'Arial', 'size' => 11],
            ['spaceBefore' => 240, 'spaceAfter' => 720]
        );
        $section->addText('Duncan Gateru',
            ['name' => 'Arial', 'size' => 11, 'bold' => true],
            ['spaceAfter' => 60, 'spaceBefore' => 0]
        );
        $section->addText('Managing Partner, Taxgen Consultants LLP',
            ['name' => 'Arial', 'size' => 9, 'color' => '666666'],
            ['spaceAfter' => 0]
        );
    }

    private function baseWord(): PhpWord
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(11);

        return $phpWord;
    }

    private function flatTable(
        string $bg,
        ?int $mt = null,
        ?int $mb = null,
        ?int $ml = null,
        ?int $mr = null
    ): array {
        return [
            'bgColor'          => $bg,
            'borderSize'       => 0,
            'borderColor'      => $bg,
            'cellMarginTop'    => $mt ?? Converter::cmToTwip(0.2),
            'cellMarginBottom' => $mb ?? Converter::cmToTwip(0.2),
            'cellMarginLeft'   => $ml ?? Converter::cmToTwip(0.3),
            'cellMarginRight'  => $mr ?? Converter::cmToTwip(0.3),
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

    private function viewData(): array
    {
        return [
            'logo'      => public_path('images/logo-footer.png'),
            'title'     => 'Official Correspondence',
            'reference' => null,
            'date'      => now()->format('d F Y'),
            'body'      => null,
        ];
    }
}
