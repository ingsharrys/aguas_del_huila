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
// Controladores para páginel buscadoras
use App\Http\Controllers\SearchController;
// Manejar imagenes dentro del editor de texto
use App\Http\Controllers\UploadController;
Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload.image');

// Página principal pública
Route::get('/', [HomeController::class, 'index'])->name('home');
// Página general de noticias
Route::get('/noticias/blogs', [NoticiaController::class, 'blog'])->name('noticias.blog');
// Página individual de noticias
Route::get('/noticias/{slug}/{id}', [NoticiaController::class, 'article'])->name('noticias.article');
// Página individual de servicios
Route::get('/servicios/{slug}/{id}', [ServicioController::class, 'article'])->name('servicios.article');
// Página general de posts
Route::get('/pda/{slug?}', [PostController::class, 'show'])->name('posts.show');
// Página general de descargas
Route::get('/documentos', [PostController::class, 'download'])->name('posts.download');
// Página general de descargas por posts
Route::get('/documentos/{slug}', [PostController::class, 'file'])->name('posts.file');

// ===============================================================================================================
// Contratacion ==================================================================================================
// Pagina contratacion parte 1
Route::view('/contratacion/procesos-contractuales', 'contratacion.contrato')->name('contratacionuno');
// Pagina contratacion parte 2
Route::view('/contratacion/procesos-contractuales-dos', 'contratacion.contratodos')->name('contrataciondos');

// ===============================================================================================================
// Institucional =================================================================================================
// historia - institucional
Route::view('/institucional/historia', 'institucional.historia')->name('historia');
// funciones generales
Route::view('/institucional/funciones-generales', 'institucional.funcionesgenerales')->name('funcionesgenerales');
// imagen corporativa

// nuestro gerente
Route::view('/institucional/representante-legal', 'institucional.nuestrogerente')->name('nuestrogerente');
// gestion calidad
Route::view('/institucional/gestion-calidad', 'institucional.gestioncalidad')->name('gestioncalidad');
// normatividad

// induccion-aguas-del-huila
Route::view('/institucional/induccion-aguas-del-huila', 'institucional.induccion')->name('induccion');
// directorio de entidades

// directorio aguas del huia
Route::view('/institucional/directorio-aguas-del-huila', 'institucional.directorio')->name('directorio');
// glosario
Route::view('/institucional/glosario', 'institucional.glosario')->name('glosario');
// preguntas-frecuentes
Route::view('/institucional/preguntas-frecuentes', 'institucional.preguntasfrecuentes')->name('preguntasfrecuentes');
// Planes de Desarrollo Departamental

// ===============================================================================================================
// transparencia =================================================================================================
// transparencia
Route::view('/transparencia-y-acceso-a-la-informacion-publica', 'transparencia.transparencia')->name('transparencia');
// entes-de-control
Route::view('/transparencia-y-acceso-a-la-informacion-publica/entes-de-control', 'transparencia.entescontrol')->name('entescontrol');
// oficinas
Route::view('/transparencia-y-acceso-a-la-informacion-publica/oficinas-aguas-del-huila', 'transparencia.oficinas')->name('oficinas');

// ===============================================================================================================
// Participa =================================================================================================
// participacion 
Route::get('/participa', [HomeController::class, 'blog'])->name('participacion');
// convocatoria 
Route::view('/participa/convocatorias', 'participacion.convocatoria')->name('convocatoria');
// calendario 
Route::view('/participa/calendario', 'participacion.calendario')->name('calendario');
// pqr 
Route::view('/participa/pqr', 'participacion.pqr')->name('pqr');
// foro 
Route::view('/participa/foro', 'participacion.foro')->name('foro');
// chat 
Route::view('/participa/chat', 'participacion.chat')->name('chat');
// denuncias 
Route::view('/participa/denuncias', 'participacion.denuncias')->name('denuncias');
// directorio-funcionarios 
Route::view('/participa/directorio-funcionarios', 'participacion.directoriofuncionarios')->name('directoriofuncionarios');

// ===============================================================================================================
// pagos =================================================================================================
Route::view('/pagos-en-linea', 'pagos')->name('pagos');

// ===============================================================================================================
// nacederos =================================================================================================
Route::view('/nacederos', 'nacederos')->name('nacederos');

// buscador =================================================================================================
Route::get('/buscar', [SearchController::class, 'index'])->name('search');

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
Route::prefix('dashboard')->group(function () {

    // Administrador y Editor
    Route::middleware(['auth', 'role:Administrador|Editor'])->group(function () {
        Route::resource('noticias', NoticiaController::class);
        Route::resource('servicios', ServicioController::class);
        Route::resource('posts', PostController::class);
        Route::resource('archivos', ArchivoController::class);
        Route::resource('banners', BannerController::class);
    });

    // Solo Administrador
    Route::middleware(['auth', 'role:Administrador'])->group(function () {
        Route::resource('categorias', CategoriaController::class);
        Route::resource('usuarios', UsuarioController::class);
    });

});