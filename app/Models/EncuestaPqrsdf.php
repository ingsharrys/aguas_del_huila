<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\DepartamentoCol;
use App\Models\Municipio;
use App\Models\Area;
use App\Models\User;
use App\Models\PqrsdfRespuesta;
use App\Models\PqrsdfAsignacion;

class EncuestaPqrsdf extends Model
{
    protected $table = 'encuesta_pqrsdf';

    protected $fillable = [

        'ip_address',
        'discapacidad',
        'tipo_discapacidad',
        'otra_discapacidad',

        'identificado_anonimo',

        'tipo_solicitante',
        'tipo_identificacion',
        'numero_identificacion',

        'razon_social',
        'nombre_usuario',
        'apellido_usuario',

        'correo_electronico',

        'pais',
        'otro_pais',

        'departamento_id',
        'municipio_id',

        'direccion',

        'fijo',
        'movil',

        'tipo_pqrsf',
        'tipo_respuesta',
        'direccion_mensajeria',

        'asunto',
        'descripcion',

        'codigo_radicado',

        'estado',
        'motivo_cancelacion',
        'cancelado_id',
        'fecha_cancelacion',
        'area_id',
        'user_id',
        'fecha_limite_respuesta',

        'fecha_respuesta',

        'autoriza'

    ];

    public function departamento()
    {
        return $this->belongsTo(
            DepartamentoCol::class,
            'departamento_id'
        );
    }

    public function municipio()
    {
        return $this->belongsTo(
            Municipio::class,
            'municipio_id'
        );
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function respuestas()
    {
        return $this->hasMany(
            PqrsdfRespuesta::class,
            'pqrsdf_id'
        );
    }

    // Historial completo de asignaciones
    public function asignaciones()
    {
        return $this->hasMany(PqrsdfAsignacion::class, 'encuesta_pqrsdf_id')->latest();
    }

    // Opcional: relación con el usuario que realizó la última asignación
    public function asignadoPor()
    {
        return $this->belongsTo(User::class, 'asignado_por_id');
    }

    // Cancelado por
    public function usuarioCancelado()
    {
        return $this->belongsTo(User::class, 'cancelado_id');
    }
    
}