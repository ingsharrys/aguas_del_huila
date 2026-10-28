<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestConocimiento extends Model
{
    protected $table = 'test_conocimientos';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'estado',
    ];

    public function preguntas(): HasMany
    {
        return $this->hasMany(TestPregunta::class, 'test_id');
    }

    public function intentos(): HasMany
    {
        return $this->hasMany(TestIntento::class, 'test_id');
    }

    public function preguntasActivas(): HasMany
    {
        return $this->hasMany(TestPregunta::class, 'test_id')
            ->where('estado', 'Activo')
            ->orderBy('orden');
    }
}