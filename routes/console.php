<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// ejecuciones de comandos
use Illuminate\Support\Facades\Schedule;
Schedule::command('users:desactivar-vencidos')->daily();
Schedule::command('pqrsdf:alertas-vencimiento')->dailyAt('07:00')->withoutOverlapping();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Mueve al disco privado los adjuntos de ciudadanos que quedaron en la carpeta pública
Artisan::command('pqrsdf:proteger-adjuntos {--dry-run : Solo mostrar lo que se movería}', function () {
    $movidos = 0;

    App\Models\PqrsdfArchivos::query()->orderBy('id')->each(function ($archivo) use (&$movidos) {
        $publico = Illuminate\Support\Facades\Storage::disk('public');
        $privado = Illuminate\Support\Facades\Storage::disk('local');

        if (!$publico->exists($archivo->ruta) || $privado->exists($archivo->ruta)) {
            return;
        }

        $this->line(($this->option('dry-run') ? '[simulación] ' : '') . $archivo->ruta);

        if (!$this->option('dry-run')) {
            $privado->writeStream($archivo->ruta, $publico->readStream($archivo->ruta));
            $publico->delete($archivo->ruta);
        }

        $movidos++;
    });

    $this->info(($this->option('dry-run') ? 'Se moverían' : 'Movidos') . " {$movidos} adjuntos al disco privado.");
})->purpose('Proteger adjuntos de PQRSDF moviéndolos al disco privado');
