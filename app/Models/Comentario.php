<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    protected $table = 'comentarios_archivos';

    protected $fillable = [
        'archivo_id',
        'identificacion',
        'nombre',
        'departamento_id',
        'comentario',
        'acepta_terminos',
        'aprobado'
    ];

    public function archivo()
    {
        return $this->belongsTo(Archivo::class);
    }

    public function departamento()
    {
        return $this->belongsTo(DepartamentoCol::class, 'departamento_id');
    }

}
