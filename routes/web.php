<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// Controladores para administrador
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\BannerController;
// Controladores para páginas
use App\Http\Controllers\HomeController;
// Manejar imagenes dentro del editor de texto
use App\Http\Controllers\UploadController;
Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload.image');

// Página principal pública
Route::get('/', [HomeController::class, 'index'])->name('home');

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
// Administrador y Editor
Route::middleware(['auth', 'role:Administrador|Editor'])->group(function () {
    Route::resource('noticias', NoticiaController::class);
    Route::resource('servicios', ServicioController::class);
    Route::resource('posts', PostController::class);
    Route::resource('archivos', ArchivoController::class);
    Route::resource('banners', BannerController::class);
});

// Grupo de rutas del panel de administración
// Administrador
Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('usuarios', UsuarioController::class);
});