<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use App\Models\User;

// ejecuciones de comandos
use Illuminate\Support\Facades\Schedule;
Schedule::command('users:desactivar-vencidos')->daily();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Cambiar la contraseña de un usuario por username o correo (la clave se pide oculta)
Artisan::command('usuario:cambiar-clave {login=admin}', function (string $login) {
    $login = Str::lower(trim($login));

    $user = User::whereRaw('LOWER(username) = ?', [$login])
        ->orWhereRaw('LOWER(email) = ?', [$login])
        ->first();

    if (!$user) {
        $this->error("No existe un usuario con username o correo: {$login}");
        return 1;
    }

    $this->info("Usuario: {$user->username} <{$user->email}> (id {$user->id})");

    $clave = $this->secret('Nueva contraseña (mínimo 8 caracteres)');
    $confirmacion = $this->secret('Repite la nueva contraseña');

    if (strlen((string) $clave) < 8) {
        $this->error('La contraseña debe tener al menos 8 caracteres.');
        return 1;
    }

    if ($clave !== $confirmacion) {
        $this->error('Las contraseñas no coinciden.');
        return 1;
    }

    // El cast 'hashed' del modelo User la encripta automáticamente
    $user->password = $clave;
    $user->save();

    $this->info('Contraseña actualizada correctamente.');
    return 0;
})->purpose('Cambiar la contraseña de un usuario');
