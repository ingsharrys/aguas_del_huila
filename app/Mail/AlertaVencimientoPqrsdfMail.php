<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\EncuestaPqrsdf;
use App\Models\User;

class AlertaVencimientoPqrsdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public EncuestaPqrsdf $pqrs,
        public User $destinatario,
        public string $tipo
    ) {}

    public function envelope(): Envelope
    {
        $asunto = match ($this->tipo) {
            'vencimiento_revision' =>
                'Alerta: PQRSDF próxima a vencer en revisión',

            'vencimiento_corregir' =>
                'Alerta: PQRSDF próxima a vencer - Corrección',

            default =>
                'Alerta: PQRSDF próxima a vencer',
        };

        return new Envelope(
            subject: $asunto,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pqrs.vencimiento',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

