<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Servicio;
// Contador de vistas
use App\Helpers\ViewStats;
use Illuminate\Support\Facades\Route;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Compartir datos con la vista parcial del navbar
        View::composer('partials.navbar', function ($view) {
            // Listado de posts tipo PDA
            $pdaPosts = Post::where('parent_id', 13)->orderBy('nombre')->get();
            // Listado de posts para descargas
            $descargasPosts = Post::where('parent_id', null)->limit(18)->orderBy('nombre')->get();
            // Listado de servicios
            $servicios = Servicio::orderBy('nombre')->get();
            // Enviar los datos a la vista
            $view->with([
                'pdaPosts' => $pdaPosts,
                'descargas' => $descargasPosts,
                'servicios' => $servicios,
            ]);
        });

        // Composer global: se ejecuta en TODAS las vistas publicas
        View::composer([
            'home',
            'pagos',
            'nacederos',
            'directoriofuncionarios',
            'denuncias',
            'chat',
            'foro',
            'pqr',
            'calendario',
            'convocatoria',
            'participacion',
            'oficinas',
            'entescontrol',
            'transparencia',
            'preguntasfrecuentes',
            'glosario',
            'directorio',
            'induccion',
            'gestioncalidad',
            'nuestrogerente',
            'funcionesgenerales',
            'historia',
            'posts.*',
            'noticias.*'
        ], function ($view) {

            $route = request()->path();

            if ($route) {

                $stats = ViewStats::stats($route);

                $view->with('stats', $stats);
            }
        });
    }
}
