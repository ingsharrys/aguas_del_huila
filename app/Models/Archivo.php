<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'archivo',
        'post_id',
    ];

    protected static function booted()
    {
        static::creating(function ($archivo) {
            $archivo->slug = Str::slug($archivo->nombre);
        });
    }

    // Relaciones
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
