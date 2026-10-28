<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CuestionarioCacsp extends Model
{
    use HasFactory;

    protected $table = 'cuestionarios_cacsp';

    protected $fillable = [
        'municipio_id',
        'ubicacion',
        'estrato',
        'sector',
        'nombre',
        'edad',
        'sexo',
        'direccion',
        'barrio',
        'telefono',
        'fecha_encuesta',
    ];

    protected $casts = [
        'fecha_encuesta' => 'date',
        'estrato' => 'integer',
        'edad' => 'integer',
    ];

    /**
     * Relación 1 a N con las respuestas del cuestionario.
     */
    public function respuestas(): HasMany
    {
        return $this->hasMany(CuestionarioCacspRespuesta::class, 'cuestionario_id');
    }
}