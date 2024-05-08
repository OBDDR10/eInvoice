<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfContent;
    public $filename;
    public $data;
    public $company;
    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($pdfContent, $filename, $data, $company, $details)
    {
        $this->pdfContent = $pdfContent;
        $this->filename = $filename;
        $this->data = $data;
        $this->company = $company;
        $this->details = $details;
    }

    public function build()
    {
        return $this->view('invoices.pdf')
                    ->attachData($this->pdfContent, $this->filename, [
                        'mime' => 'application/pdf',
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'invoices.pdf'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
