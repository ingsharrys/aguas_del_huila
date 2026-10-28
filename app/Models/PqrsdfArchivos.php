<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PqrsdfArchivos extends Model
{
    protected $table = 'pqrsdf_archivos';

    protected $fillable = [
        'pqrsdf_id',
        'nombre_original',
        'nombre_archivo',
        'ruta',
        'extension',
        'mime_type',
        'tamano',
    ];

    /**
     * PQR a la que pertenece el archivo.
     */
    public function pqrsdf(): BelongsTo
    {
        return $this->belongsTo(EncuestaPqrsdf::class,'pqrsdf_id');
    }
}
