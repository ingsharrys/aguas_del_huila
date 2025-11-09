<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Servicio;
use App\Models\Post;
use App\Models\Archivo;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;

        // Buscar en noticias
        $noticias = Noticia::where('titulo', 'like', "%$q%")->get();

        // Buscar en servicios
        $servicios = Servicio::where('nombre', 'like', "%$q%")->get();

        // Buscar en paginas (posts)
        $paginas = Post::where('nombre', 'like', "%$q%")->get();

        // Buscar en archvivos
        $archivos = Archivo::where('nombre', 'like', "%$q%")->get();

        return view('search.results', compact('q', 'noticias', 'servicios', 'paginas', 'archivos'));
    }

}
