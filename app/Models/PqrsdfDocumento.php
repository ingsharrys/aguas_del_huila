<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PqrsdfDocumento extends Model
{
    protected $table = 'pqrsdf_documentos';

    protected $fillable = [
        'respuesta_id',
        'nombre_original',
        'nombre_archivo',
        'ruta',
        'extension',
        'mime_type',
        'tamano',
    ];

    /*
    |--------------------------------------------------------------------------
    | Respuesta
    |--------------------------------------------------------------------------
    */

    public function respuesta()
    {
        return $this->belongsTo(
            PqrsdfRespuesta::class,
            'respuesta_id'
        );
    }
}