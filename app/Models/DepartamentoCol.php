<?php

namespace App\Models;

use App\Models\Municipio;
use Illuminate\Database\Eloquent\Model;

class DepartamentoCol extends Model
{
    protected $table = 'departamentos_col';

    protected $fillable = [
        'nombre',
        'codigo_dane',
        'estado'
    ];

    public $timestamps = true;

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'departamento_id');
    }

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

}
