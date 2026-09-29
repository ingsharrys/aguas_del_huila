<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuesta_satisfaccion';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'tramite',
        'medio',
        'informacion',
        'facilidad',
        'grupo',
        'beneficio',
        'costos',
    ];
}