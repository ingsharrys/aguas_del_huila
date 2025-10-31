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
        'imagen_portada',
        'contenido',
        'categoria_id',
        'user_id',
        'publicado'
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Generar slug automáticamente
    protected static function booted()
    {
        static::creating(function ($noticia) {
            $noticia->slug = Str::slug($noticia->titulo);
        });
    }
}
