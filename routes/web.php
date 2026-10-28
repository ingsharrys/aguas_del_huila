<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Http\Controllers\EstadisticasController;
// Controladores para administrador
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\OrganigramaController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\PqrsController;
use App\Http\Controllers\EncuestaAdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestPreguntaController;
use App\Http\Controllers\CuestionarioController;
use App\Http\Controllers\ConfiguracionCorreoController;
// Controladores para páginas
use App\Http\Controllers\HomeController;
// Controladores para páginel buscadoras
use App\Http\Controllers\SearchController;
// Manejar imagenes dentro del editor de texto
use App\Http\Controllers\UploadController;
Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload.image');

// Página principal pública
Route::get('/', [HomeController::class, 'index'])->name('home');
// Página Mapa del Sitio
Route::view('/mapa-del-sitio', 'mapadelsitio')->name('mapadelsitio');
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
Route::get('/documentos/{path}', [PostController::class, 'file'])
    ->where('path', '.*')
    ->name('posts.file');
// Página vista del archivo para descargas
Route::get('/archivos/documentos/{postSlug}/{archivoSlug}', [PostController::class, 'document'])->name('posts.document');
// Guardar comentario del archivo
Route::post('/comentarios-archivo/{archivo}',[PostController::class,'guardarComentario'])->name('archivo.comentario');

// ===============================================================================================================
// Contratacion ==================================================================================================
// Pagina contratacion parte 1
Route::view('/contratacion/procesos-contractuales', 'contratacion.contrato')->name('contrato');
// Pagina contratacion parte 2
Route::view('/contratacion/procesos-contractuales-dos', 'contratacion.contratodos')->name('contratodos');

// ===============================================================================================================
// Institucional =================================================================================================
// historia - institucional
Route::view('/institucional/historia', 'institucional.historia')->name('historia');
// Mision y Vison - institucional
Route::view('/institucional/mision-y-vision', 'institucional.misionvision')->name('misionvision');
// organigrama - institucional
Route::view('/institucional/organigrama', 'institucional.organigrama')->name('organigrama');
// Organigrama bloques
Route::get('/institucional/organigrama/{slug}',[OrganigramaController::class, 'show'])->name('organigrama.bloques');
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
// Información para niños, niñas y adolescentes
Route::get('/transparencia-y-acceso-a-la-informacion-publica/informacion-para-ninos-ninas-y-adolescentes',[TestController::class, 'infonino'])->name('infonino');
Route::view('/transparencia-y-acceso-a-la-informacion-publica/informacion-para-ninos-ninas-y-adolescentes/pintando-a-super-agua', 'transparencia.supergota')->name('supergota');

// ===============================================================================================================
// Participa =================================================================================================
Route::view('/participa', 'participacion.participa')->name('participa');
// participacion 
Route::get('/atencion-y-servicios-a-la-ciudadania', [HomeController::class, 'blog'])->name('participacion');
// convocatoria 
Route::view('/participa/convocatorias', 'participacion.convocatoria')->name('convocatoria');
// calendario 
Route::view('/participa/calendario', 'participacion.calendario')->name('calendario');
// pqr 
Route::get('/participa/pqr', [PqrsController::class, 'index'])->name('pqr');
Route::get('/municipios/{departamento}',[PqrsController::class, 'municipios'])->name('municipios');
Route::post('/participa/pqr',[PqrsController::class, 'store'])->name('pqr.store');
Route::post('/participa/pqr/buscar', [PqrsController::class, 'searchCode'])->name('pqr.search');
Route::get('/participa/pqr/carteleravirtual', [PqrsController::class, 'carteleravirtual'])->name('carteleravirtual');
Route::get('/participa/pqr/carteleravirtual/{codigo}/respuesta',[PqrsController::class, 'consultarRespuestaCartelera'])->name('carteleravirtual.respuesta');
// foro 
Route::view('/participa/foro', 'participacion.foro')->name('foro');
// chat 
Route::view('/participa/chat', 'participacion.chat')->name('chat');
// denuncias 
Route::view('/participa/denuncias', 'participacion.denuncias')->name('denuncias');
// directorio-funcionarios 
Route::view('/participa/directorio-funcionarios', 'participacion.directoriofuncionarios')->name('directoriofuncionarios');
// Encuesta de tramites
Route::get('/atencion-y-servicios-a-la-ciudadania/encuesta-de-satisfaccion-de-tramites-y-servicios',[EncuestaController::class, 'index'])->name('encuesta.tramite');
Route::post('/atencion-y-servicios-a-la-ciudadania/encuesta-de-satisfaccion-de-tramites-y-servicios',[EncuestaController::class, 'store'])->name('tramite.store');
// Encuesta de satisfacción
Route::get('/transparencia-y-acceso-a-la-informacion-publica/encuesta-de-evaluacion',[EncuestaController::class, 'formEvaluacion'])->name('encuesta.evaluacion');
Route::post('/transparencia-y-acceso-a-la-informacion-publica/encuesta-de-evaluacion',[EncuestaController::class, 'storeEvaluacion'])->name('evaluacion.store');
// Cuestionario de atencion al cliente
Route::get('/transparencia-y-acceso-a-la-informacion-publica/cuestionario-de-evaluacion-de-atencion-al-cliente-servicios-publicos',[CuestionarioController::class, 'formCACSP'])->name('cuestionario.cacsp');
Route::post('/transparencia-y-acceso-a-la-informacion-publica/cuestionario-de-evaluacion-de-atencion-al-cliente-servicios-publicos',[CuestionarioController::class, 'storeCACSP'])->name('cuestionario.cacsp.store');


// ===============================================================================================================
// pagos =================================================================================================
Route::view('/pagos-en-linea', 'pagos')->name('pagos');

// ===============================================================================================================
// nacederos =================================================================================================
Route::view('/nacederos', 'nacederos')->name('nacederos');

// buscador =================================================================================================
Route::get('/buscar', [SearchController::class, 'index'])->name('search');

// documentos de gestion =================================================================================================
Route::get('/gestion-calidad/{carpeta?}', [DocumentosController::class, 'index'])
    ->where('carpeta', '.*')
    ->name('gestion-calidad');

// Dashboard (solo usuarios autenticados y verificados)
Route::get('/dashboard', [EstadisticasController::class, 'index'])
    ->middleware(['auth', 'user.active'])
    ->name('dashboard');

// Grupo de rutas de configuración (solo autenticados)
Route::middleware(['auth', 'user.active'])->group(function () {

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
    Route::middleware(['auth', 'user.active', 'role:Administrador|Editor'])->group(function () {
        Route::resource('banners', BannerController::class);
        Route::resource('noticias', NoticiaController::class);
        Route::resource('posts', PostController::class);
        Route::resource('archivos', ArchivoController::class);
        Route::resource('comentarios', ComentarioController::class)->only(['index','destroy']);
        Route::patch('comentarios/{comentario}/aprobar', [ComentarioController::class,'aprobar'])->name('comentarios.aprobar');
        Route::resource('funcionarios', FuncionarioController::class);
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('cargos', CargoController::class);
        });
        
    // Solo Administrador
    Route::middleware(['auth', 'user.active', 'role:Administrador'])->group(function () {
        Route::resource('servicios', ServicioController::class);
        Route::resource('organigrama', OrganigramaController::class); 
        Route::resource('categorias', CategoriaController::class);
        Route::get('/importar/archivos', [ArchivoController::class, 'importarForm'])->name('archivos.importar.form');
        Route::post('/importar/archivos/zip', [ArchivoController::class, 'importar'])->name('archivos.importar');
        // Configuración de correo (SMTP y remitentes por formulario)
        Route::controller(ConfiguracionCorreoController::class)->prefix('configuracion/correo')->group(function () {
            Route::get('/', 'edit')->name('configuracion.correo');
            Route::put('/smtp', 'updateSmtp')->name('configuracion.correo.smtp');
            Route::put('/probar', 'probar')->middleware('throttle:5,1')->name('configuracion.correo.probar');
            Route::put('/remitentes', 'updateRemitentes')->name('configuracion.correo.remitentes');
        });
    });

});

// Admin de encuestas
Route::prefix('dashboard/encuestas')->group(function () {

    // Administrador y Extranet
    Route::middleware(['auth', 'user.active', 'role:Administrador|Editor|Extranet|Control Interno'])->controller(EncuestaAdminController::class)->group(function () {
        // Dashboard principal
        Route::get('/', 'index')->name('dashboard.encuestas');
        // Encuesta de Trámites y Servicios
        Route::get('/tramites', 'tramites')->name('dashboard.encuestas.tramites');
        Route::delete('/tramites/{tramite}', 'destroyTramite')->name('dashboard.encuestas.tramites.destroy');
        // Encuesta de Evaluación
        Route::get('/evaluacion', 'evaluacion')->name('dashboard.encuestas.evaluacion');
        Route::delete('/evaluacion/{evaluacion}', 'destroy')->name('dashboard.encuestas.evaluacion.destroy');
    });

});

// Admin de comunicaciones
Route::prefix('dashboard/comunicaciones')->group(function () {

    // Administrador y Extranet
    Route::middleware(['auth', 'user.active', 'role:Administrador|Editor|Extranet|Control Interno'])->controller(EncuestaAdminController::class)->group(function () {
        // Dashboard principal
        Route::get('/', 'comunicaciones')->name('dashboard.comunicaciones');
        // PQRSDF
        Route::get('/reportes', 'reportes')->name('dashboard.comunicaciones.reportes');
        Route::get('/pqrsdf', 'pqrsdf')->name('dashboard.comunicaciones.pqrsdf');
        Route::get('/pqrsdf/exportar','exportarPqrsdf')->name('dashboard.comunicaciones.pqrsdf.exportar');
        Route::get('/pqrsdf/{id}', 'showPqrsdf')->name('dashboard.comunicaciones.pqrsdf.show');
        Route::put('/pqrsdf/cancelar/{id}','cancelarPqrsdf')->name('dashboard.comunicaciones.pqrsdf.cancelar');
        Route::delete('/pqrsdf/{pqrsdf}', 'destroyPqrsdf')->name('dashboard.comunicaciones.pqrsdf.destroy');
        Route::post('/pqrsdf/{id}/asignar', 'asignarArea')->name('dashboard.comunicaciones.pqrsdf.asignar');
        Route::post('/pqrsdf/responder','respuesta')->name('dashboard.comunicaciones.pqrsdf.responder');
        Route::get('/pqrsdf/{pqrsdf}/respuestas', 'listaRespuestas')->name('dashboard.comunicaciones.pqrsdf.respuestas');
        Route::post('/pqrsdf/respuestas/{id}/aprobar', 'aprobarRespuesta')->name('dashboard.comunicaciones.pqrsdf.respuestas.aprobar');
        Route::post('/pqrsdf/respuestas/{id}/devolver', 'devolverRespuesta')->name('dashboard.comunicaciones.pqrsdf.respuestas.devolver');
    });

});

// Admin de test
Route::prefix('dashboard/test')->group(function () {
    Route::middleware(['auth', 'user.active', 'role:Administrador|Editor'])->controller(TestController::class)->group(function () {
        // Dashboard principal
        Route::get('/', 'test')->name('test.dashboard');
        // CRUD testes
        Route::resource('testes', TestController::class);
        // Preguntas de un test
        Route::prefix('testes/{teste}/preguntas')
            ->controller(TestPreguntaController::class)
            ->group(function () {

                Route::get('/', 'index')
                    ->name('testes.preguntas.index');

                Route::get('/create', 'create')
                    ->name('testes.preguntas.create');

                Route::post('/', 'store')
                    ->name('testes.preguntas.store');

                Route::get('/{pregunta}/edit', 'edit')
                    ->name('testes.preguntas.edit');

                Route::put('/{pregunta}', 'update')
                    ->name('testes.preguntas.update');

                Route::delete('/{pregunta}', 'destroy')
                    ->name('testes.preguntas.destroy');
            });
        // Listado de participantes de un test
        Route::prefix('testes/{teste}/participantes')
            ->controller(TestController::class)
            ->group(function () {

                Route::get('/', 'participantes')
                    ->name('testes.participantes.index');

                Route::delete('/{intento}', 'participantesDestroy')
                    ->name('testes.participantes.destroy');
            });
    });
});
        
// Vista del test para el público
Route::get('/transparencia-y-acceso-a-la-informacion-publica/informacion-para-ninos-ninas-y-adolescentes/{slug}',[TestController::class, 'show'])->name('test.publico');
Route::post('/transparencia-y-acceso-a-la-informacion-publica/informacion-para-ninos-ninas-y-adolescentes/{slug}',[TestController::class, 'resultados'])->name('test.publico.store');