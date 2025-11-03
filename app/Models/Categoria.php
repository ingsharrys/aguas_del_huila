<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
    ];

    // Ejemplo de relación con noticias
    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'categoria_id');
    }

    // Generar slug automáticamente
    protected static function booted()
    {
        static::creating(function ($categoria) {
            $categoria->slug = Str::slug($categoria->nombre);
        });
    }

}
