<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\EncuestaPqrsdf;

class DesactivarUsuariosVencidos extends Command
{
    protected $signature = 'users:desactivar-vencidos';
    protected $description = 'Desactiva los usuarios cuya fecha de terminación expiró y desasigna sus PQR pendientes';

    public function handle()
    {
        // 1. Obtener los usuarios que cumplen la condición para ser desactivados
        $usuariosVencidos = User::where('estado', 'Activado')
            ->whereNotNull('fecha_terminacion')
            ->whereDate('fecha_terminacion', '<', now()->toDateString())
            ->get();

        $afectados = $usuariosVencidos->count();

        if ($afectados === 0) {
            $this->info("No hay usuarios con contrato vencido para desactivar hoy.");
            return;
        }

        // Obtener los IDs de los usuarios a desactivar
        $userIds = $usuariosVencidos->pluck('id')->toArray();

        // 2. Desactivar los usuarios
        User::whereIn('id', $userIds)->update(['estado' => 'Desactivado']);

        // 3. Buscar las PQRSDF que estaban asignadas a estos usuarios y aún no están respondidas
        $pqrsPendientes = EncuestaPqrsdf::whereIn('user_id', $userIds)
            ->where('estado', 'Asignada') // Solo las que están pendientes de respuesta
            ->get();

        $totalPqrs = $pqrsPendientes->count();

        // 4. Desasignar las PQRSDF y guardar el registro en el historial
        foreach ($pqrsPendientes as $pqrs) {
            // Devolver la PQR a la bandeja del Área (o estado original)
            $pqrs->update([
                'user_id' => null,
                'estado'  => 'Radicada' // Pasa a Radicada porque ya no tiene usuario responsable
            ]);

            // Crear el registro de trazabilidad indicando por qué se desasignó automáticamente
            $pqrs->asignaciones()->create([
                'area_id'         => $pqrs->area_id, 
                'user_id'         => null, // Queda sin usuario
                'asignado_por_id' => null, // null porque lo hizo el sistema
                'dias'            => 0,
                'fecha_limite'    => $pqrs->fecha_limite_respuesta, // Mantiene la fecha límite original
                'motivo'          => 'Desasignación automática: El contrato/vinculación del funcionario asignado ha vencido.',
            ]);
        }

        // 5. Mostrar resumen en la consola
        $this->info("Se han desactivado {$afectados} usuario(s) con contrato vencido.");
        $this->info("Se han desasignado {$totalPqrs} PQRSDF que estaban a cargo de estos usuarios.");
    }
}