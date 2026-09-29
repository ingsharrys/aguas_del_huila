<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Area;
use App\Models\User;

class PqrsdfAsignacion extends Model
{
    protected $table = 'pqrsdf_asignaciones';

    protected $fillable = [
        'encuesta_pqrsdf_id',
        'area_id',
        'user_id',
        'asignado_por_id',
        'dias',
        'fecha_limite',
        'motivo',
    ];

    public function usuarioAsignado()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function asignadoPor()
    {
        return $this->belongsTo(User::class, 'asignado_por_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}