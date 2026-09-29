<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// ejecuciones de comandos
use Illuminate\Support\Facades\Schedule;
Schedule::command('users:desactivar-vencidos')->daily();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
