<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'contenido',
        'parent_id',
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->nombre);
        });
    }

    // Relaciones
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function obtenerDescendientesIds()
    {
        $ids = collect();

        foreach ($this->children as $child) {

            $ids->push($child->id);

            $ids = $ids->merge(
                $child->obtenerDescendientesIds()
            );
        }

        return $ids;
    }

    public function children()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }
    
    public function getFullPathAttribute()
    {
        $path = [$this->slug];
        $parent = $this->parent;
    
        while ($parent) {
            array_unshift($path, $parent->slug);
            $parent = $parent->parent;
        }
    
        return implode('/', $path);
    }

}
