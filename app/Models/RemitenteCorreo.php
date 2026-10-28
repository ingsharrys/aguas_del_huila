<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemitenteCorreo extends Model
{
    protected $table = 'remitentes_correo';

    protected $fillable = [
        'clave',
        'remitente_correo',
        'remitente_nombre',
        'responder_a',
        'destinatarios',
    ];

    /**
     * Destinatarios internos como arreglo de correos válidos.
     */
    public function listaDestinatarios(): array
    {
        return collect(preg_split('/[\s,;]+/', (string) $this->destinatarios))
            ->map(fn ($correo) => trim($correo))
            ->filter(fn ($correo) => filter_var($correo, FILTER_VALIDATE_EMAIL))
            ->unique()
            ->values()
            ->all();
    }
}
