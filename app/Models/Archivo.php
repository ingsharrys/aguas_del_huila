<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Archivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'archivo',
        'post_id',
        'comentarios',
        'inicio',
        'fin',
    ];


    // Relaciones
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

}
