<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = [
        'nombre',
        'parent_id',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Área padre.
     */
    public function parent()
    {
        return $this->belongsTo(Area::class, 'parent_id');
    }

    /**
     * Áreas hijas.
     */
    public function children()
    {
        return $this->hasMany(Area::class, 'parent_id');
    }
}