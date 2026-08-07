<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public Invoice $invoice;
    public string $pdfBinary;

    public function __construct(Invoice $invoice, string $pdfBinary)
    {
        $this->invoice = $invoice;
        $this->pdfBinary = $pdfBinary;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('taxgenconsultantsllp@gmail.com', 'Taxgen Consultants LLP'),
            subject: "Invoice {$this->invoice->invoice_number} from Taxgen Consultants LLP",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Mails.invoice',
            with: ['invoice' => $this->invoice],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfBinary, "{$this->invoice->invoice_number}.pdf")
                ->withMime('application/pdf'),
        ];
    }
}
