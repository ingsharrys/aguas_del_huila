<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CuestionarioCacspRespuesta extends Model
{
    use HasFactory;

    protected $table = 'cuestionarios_cacsp_respuestas';

    protected $fillable = [
        'cuestionario_id',
        'pregunta_key',
        'valor',
    ];

    /**
     * Relación N a 1 con el cuestionario principal.
     */
    public function cuestionario(): BelongsTo
    {
        return $this->belongsTo(CuestionarioCacsp::class, 'cuestionario_id');
    }
}