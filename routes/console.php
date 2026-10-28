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
