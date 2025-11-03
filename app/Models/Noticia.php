<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'contenido',
        'categoria_id',
        'user_id',
        'publicado',
        'imagen_portada',
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Generar slug automáticamente
    protected static function booted()
    {
        static::creating(function ($noticia) {
            $noticia->slug = Str::slug($noticia->titulo);
        });
    }
}
