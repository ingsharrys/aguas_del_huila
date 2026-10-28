<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestRespuesta extends Model
{
    protected $table = 'test_respuestas';

    protected $fillable = [
        'intento_id',
        'pregunta_id',
        'opcion_id',
        'es_correcta',
    ];

    protected $casts = [
        'es_correcta' => 'boolean',
    ];

    public function intento(): BelongsTo
    {
        return $this->belongsTo(TestIntento::class, 'intento_id');
    }

    public function pregunta(): BelongsTo
    {
        return $this->belongsTo(TestPregunta::class, 'pregunta_id');
    }

    public function opcion(): BelongsTo
    {
        return $this->belongsTo(TestOpcion::class, 'opcion_id');
    }
}