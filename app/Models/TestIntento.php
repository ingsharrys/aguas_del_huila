<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestIntento extends Model
{
    protected $table = 'test_intentos';

    protected $fillable = [
        'test_id',
        'nombre',
        'municipio_id',
        'ip_address',
        'comentario',
        'respuestas_correctas',
        'total_preguntas',
        'porcentaje',
    ];

    protected $casts = [
        'porcentaje' => 'decimal:2',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(TestConocimiento::class, 'test_id'); 
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function respuestas(): HasMany
    {
        return $this->hasMany(TestRespuesta::class, 'intento_id');
    }
}