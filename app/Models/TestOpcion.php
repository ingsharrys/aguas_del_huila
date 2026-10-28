<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestOpcion extends Model
{
    protected $table = 'test_opciones';

    protected $fillable = [
        'pregunta_id',
        'letra',
        'texto',
        'es_correcta',
        'orden',
    ];

    protected $casts = [
        'es_correcta' => 'boolean',
    ];

    public function pregunta(): BelongsTo
    {
        return $this->belongsTo(TestPregunta::class, 'pregunta_id'); 
    }
}