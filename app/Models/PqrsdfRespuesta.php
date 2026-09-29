<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PqrsdfDocumento;

class PqrsdfRespuesta extends Model
{
    protected $table = 'pqrsdf_respuestas';

    protected $fillable = [
        'pqrsdf_id',
        'usuario_id',
        'tipo_respuesta',
        'correo',
        'direccion',
        'empresa_encomienda',
        'numero_guia',
        'titulo_respuesta',
        'texto_respuesta',
        'estado',
        'observaciones',
        'revisado_id',
        'fecha_revision',
    ];

    /*
    |--------------------------------------------------------------------------
    | PQR
    |--------------------------------------------------------------------------
    */

    public function pqrsdf()
    {
        return $this->belongsTo(EncuestaPqrsdf::class, 'pqrsdf_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Usuario que realizó la respuesta
    |--------------------------------------------------------------------------
    */

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Documentos
    |--------------------------------------------------------------------------
    */

    public function documentos()
    {
        return $this->hasMany(PqrsdfDocumento::class, 'respuesta_id');
    }

    public function revisor()
    {
        return $this->belongsTo(User::class, 'revisado_id');
    }
}