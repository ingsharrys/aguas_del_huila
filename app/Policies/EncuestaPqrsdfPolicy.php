<?php

namespace App\Policies;

use App\Models\EncuestaPqrsdf;
use App\Models\PqrsdfRespuesta;
use App\Models\User;

/**
 * Permisos sobre PQRSDF. Replica en el servidor las reglas del listado y de las vistas.
 */
class EncuestaPqrsdfPolicy
{
    /**
     * Ver una PQRSDF (detalle, respuestas y adjuntos).
     */
    public function ver(User $user, EncuestaPqrsdf $pqrs): bool
    {
        if ($user->hasAnyRole(['Administrador', 'Editor', 'Control Interno'])) {
            return true;
        }

        if ($user->hasRole('Extranet')) {
            // Extranet: las asignadas a él; si es jefe, también las de su área
            return $pqrs->user_id == $user->id
                || ($user->es_jefe && $user->area_id && $pqrs->area_id == $user->area_id);
        }

        return false;
    }

    /**
     * Asignar, responder, devolver o cancelar.
     */
    public function gestionar(User $user, EncuestaPqrsdf $pqrs): bool
    {
        if (!$this->ver($user, $pqrs)) {
            return false;
        }

        // Control Interno solo gestiona las PQRSDF de su área
        if ($user->hasRole('Control Interno') && !$user->hasAnyRole(['Administrador', 'Editor'])) {
            return $pqrs->area_id == config('pqrsdf.area_control_interno');
        }

        return true;
    }

    /**
     * Aprobar o devolver una respuesta en revisión: Administrador, Editor o jefe.
     */
    public function aprobarRespuesta(User $user, EncuestaPqrsdf $pqrs, PqrsdfRespuesta $respuesta): bool
    {
        if (!$this->gestionar($user, $pqrs) || $respuesta->estado != 1) {
            return false;
        }

        if ($user->hasAnyRole(['Administrador', 'Editor'])) {
            return true;
        }

        return (bool) $user->es_jefe;
    }

    public function eliminar(User $user, EncuestaPqrsdf $pqrs): bool
    {
        return $user->hasRole('Administrador');
    }
}
