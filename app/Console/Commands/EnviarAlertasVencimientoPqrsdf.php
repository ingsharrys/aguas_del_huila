<?php

namespace App\Console\Commands;

use App\Models\EncuestaPqrsdf;
use App\Models\User;
use App\Mail\AlertaVencimientoPqrsdfMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Services\CorreoService;
use Illuminate\Support\Facades\Log;

class EnviarAlertasVencimientoPqrsdf extends Command
{
    protected $signature = 'pqrsdf:alertas-vencimiento';

    protected $description = 'Envía alertas por vencimiento próximo de PQRSDF';

    public function handle(): int
    {
        // Alertar cuando falten 2 días hábiles o menos (si el cron falla un día, no se pierde la alerta;
        // el registro en pqrsdf_notificaciones evita enviarla dos veces)
        $fechaObjetivo = \App\Support\DiasHabiles::sumar(Carbon::today(), 2)->toDateString();

        $pqrs = EncuestaPqrsdf::with('usuario')
            ->whereDate('fecha_limite_respuesta', '>=', Carbon::today()->toDateString())
            ->whereDate('fecha_limite_respuesta', '<=', $fechaObjetivo)
            ->whereIn('estado', ['Asignada', 'Corregir', 'Revisión'])
            ->get();

        foreach ($pqrs as $pqr) {
            try {
                if (in_array($pqr->estado, ['Asignada', 'Corregir'], true)) {
                    $this->notificarResponsable($pqr);
                } elseif ($pqr->estado === 'Revisión') {
                    $this->notificarJefeArea($pqr);
                }
            } catch (\Throwable $e) {
                Log::error('Error procesando alerta de vencimiento PQRSDF', [
                    'pqrsdf_id' => $pqr->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $this->info("Se revisaron {$pqrs->count()} PQRSDF.");

        return self::SUCCESS;
    }

    private function notificarResponsable($pqr): void
    {
        $usuario = $pqr->usuario;

        if (!$usuario || !$usuario->email) {
            return;
        }

        $tipo = $pqr->estado === 'Asignada'
            ? 'vencimiento_asignada'
            : 'vencimiento_corregir';

        $this->enviarUnaVez($pqr, $usuario, $tipo);
    }

    private function notificarJefeArea($pqr): void
    {
        $responsable = $pqr->usuario;

        if (!$responsable || !$responsable->area_id) {
            return;
        }

        $jefes = User::where('es_jefe', 1)
            ->where('area_id', $responsable->area_id)
            ->whereNotNull('email')
            ->where('email', '<>', '')
            ->get();

        foreach ($jefes as $jefe) {
            $this->enviarUnaVez(
                $pqr,
                $jefe,
                'vencimiento_revision'
            );
        }
    }

    private function enviarUnaVez(
        EncuestaPqrsdf $pqr,
        User $destinatario,
        string $tipo
    ): void {
        $id = null;

        try {
            // Crear o recuperar el registro de notificación.
            DB::transaction(function () use (
                $pqr,
                $destinatario,
                $tipo,
                &$id
            ) {
                $notificacion = DB::table('pqrsdf_notificaciones')
                    ->where('pqrsdf_id', $pqr->id)
                    ->where('destinatario_user_id', $destinatario->id)
                    ->where('tipo_notificacion', $tipo)
                    ->lockForUpdate()
                    ->first();

                if ($notificacion && $notificacion->estado_envio === 'enviado') {
                    return;
                }

                if ($notificacion) {
                    $id = $notificacion->id;

                    DB::table('pqrsdf_notificaciones')
                        ->where('id', $id)
                        ->update([
                            'estado_envio' => 'pendiente',
                            'mensaje_error' => null,
                            'updated_at' => now(),
                        ]);

                    return;
                }

                $id = DB::table('pqrsdf_notificaciones')->insertGetId([
                    'pqrsdf_id' => $pqr->id,
                    'destinatario_user_id' => $destinatario->id,
                    'tipo_notificacion' => $tipo,
                    'estado_envio' => 'pendiente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });

            // Si ya estaba enviada, no volver a enviarla.
            if ($id === null) {
                return;
            }

            $notificacion = DB::table('pqrsdf_notificaciones')
                ->where('id', $id)
                ->first();

            if (!$notificacion || $notificacion->estado_envio === 'enviado') {
                return;
            }

            // El envío ocurre fuera de la transacción.
            CorreoService::enviar('pqrsdf_vencimiento', $destinatario->email,
                new AlertaVencimientoPqrsdfMail(
                    $pqr,
                    $destinatario,
                    $tipo
                )
            );

            DB::table('pqrsdf_notificaciones')
                ->where('id', $id)
                ->update([
                    'estado_envio' => 'enviado',
                    'fecha_envio' => now(),
                    'mensaje_error' => null,
                    'updated_at' => now(),
                ]);

        } catch (\Throwable $e) {
            if ($id !== null) {
                DB::table('pqrsdf_notificaciones')
                    ->where('id', $id)
                    ->update([
                        'estado_envio' => 'error',
                        'mensaje_error' => mb_substr($e->getMessage(), 0, 60000),
                        'updated_at' => now(),
                    ]);
            }

            Log::error('No se pudo enviar alerta PQRSDF', [
                'pqrsdf_id' => $pqr->id,
                'destinatario' => $destinatario->email,
                'tipo' => $tipo,
                'error' => $e->getMessage(),
            ]);
        }
    }
}


