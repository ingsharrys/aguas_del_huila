<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'organigrama_funcionarios';

    protected $fillable = [
        'bloque_id',
        'nombre',
        'cargo',
        'descripcion',
        'telefono',
        'correo',
        'orden',
        'activo',
        'foto',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function bloque()
    {
        return $this->belongsTo(Organigrama::class,'bloque_id');
    }

}