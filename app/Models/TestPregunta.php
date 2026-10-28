<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestPregunta extends Model
{
    protected $table = 'test_preguntas';

    protected $fillable = [
        'test_id',
        'pregunta',
        'orden',
        'estado',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(TestConocimiento::class, 'test_id'); 
    }

    public function opciones(): HasMany
    {
        return $this->hasMany(TestOpcion::class, 'pregunta_id')
            ->orderBy('orden');
    }

    public function opcionesActivas(): HasMany
    {
        return $this->hasMany(TestOpcion::class, 'pregunta_id')
            ->orderBy('orden');
    }

    public function respuestas(): HasMany
    {
        return $this->hasMany(TestRespuesta::class, 'pregunta_id');
    }
}