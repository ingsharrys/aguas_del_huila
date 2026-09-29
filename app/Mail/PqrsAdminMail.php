<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\EncuestaPqrsdf;

class PqrsAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pqrs;

    public function __construct(EncuestaPqrsdf $pqrs)
    {
        $this->pqrs = $pqrs;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva PQRSDF Radicada',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pqrs.admin',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
