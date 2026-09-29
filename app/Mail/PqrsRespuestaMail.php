<?php

namespace App\Mail;

use App\Models\PqrsdfRespuesta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;

class PqrsRespuestaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $respuesta;

    public function __construct(PqrsdfRespuesta $respuesta)
    {
        $this->respuesta = $respuesta;
    }


    /**
     * Asunto del correo
     */
    public function envelope(): Envelope
    {
        return new Envelope(

            subject: 'Radicado: ' . $this->respuesta->pqrsdf->codigo_radicado . ' - ' . $this->respuesta->titulo_respuesta

        );
    }


    /**
     * Vista del correo
     */
    public function content(): Content
    {
        return new Content(

            view: 'emails.pqrs.respuesta'

        );
    }


    /**
     * Archivos adjuntos
     */
    public function attachments(): array
    {
        $adjuntos = [];

        foreach ($this->respuesta->documentos as $documento) {

            $path = Storage::disk('public')
                ->path($documento->ruta);

            if (file_exists($path)) {

                $adjuntos[] = Attachment::fromPath($path)
                    ->as($documento->nombre_original)
                    ->withMime($documento->mime_type);

            }
        }

        return $adjuntos;
    }
}