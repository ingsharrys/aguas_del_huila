<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncuestaEvaluacion extends Model
{
    protected $table = 'encuesta_evaluacion';

    protected $fillable = [
        'actualizada',
        'informacion',
        'satisfaccion',
        'facilidad',
    ];
}