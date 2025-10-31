<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Http\Controllers\NoticiaController;

// Página principal pública
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (solo usuarios autenticados y verificados)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grupo de rutas de configuración (solo autenticados)
Route::middleware(['auth'])->group(function () {

    // Configuración del usuario (Livewire Volt)
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Grupo de rutas del panel de administración
Route::middleware(['auth', 'role:Administrador|Editor'])->group(function () {
    Route::resource('noticias', NoticiaController::class);
});