<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'titulo',
        'contenido',
        'icono',
        'imagen_portada',
    ];

    // Generar slug automáticamente
    protected static function booted()
    {
        static::creating(function ($servicio) {
            $servicio->slug = Str::slug($servicio->nombre);
        });
    }
}

