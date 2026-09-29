<?php

namespace App\Models;

use App\Models\DepartamentoCol;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios_col';

    protected $fillable = [
        'departamento_id',
        'nombre',
        'codigo_dane',
        'estado'
    ];

    public $timestamps = false;

    public function departamento()
    {
        return $this->belongsTo(DepartamentoCol::class);
    }
}