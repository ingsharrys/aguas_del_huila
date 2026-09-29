<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organigrama extends Model
{
    protected $table = 'organigrama_bloques';

    protected $fillable = [
        'parent_id',
        'nombre',
        'slug',
        'orden',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Bloque padre
    public function parent()
    {
        return $this->belongsTo(Organigrama::class, 'parent_id');
    }

    // Bloques hijos
    public function children()
    {
        return $this->hasMany(Organigrama::class, 'parent_id')
                    ->orderBy('orden');
    }

    // Funcionarios del bloque
    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'bloque_id')
                    ->orderBy('orden');
    }
}