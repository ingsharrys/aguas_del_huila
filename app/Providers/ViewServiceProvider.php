<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Servicio;

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
    }
}
