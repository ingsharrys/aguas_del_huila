<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Servicio;
use App\Models\Post;
use App\Models\Archivo;
use App\Models\Section;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = trim($request->q);
        $limit = 20;

        $noticias = Noticia::where('titulo', 'like', "%$q%")
            ->paginate(10, ['*'], 'noticias_page')
            ->appends(['q' => $q]);
        
        $servicios = Servicio::where('nombre', 'like', "$q%")
            ->paginate(10, ['*'], 'servicios_page')
            ->appends(['q' => $q]);
        
        $paginas = Post::where('nombre', 'like', "%$q%")
            ->paginate(10, ['*'], 'paginas_page')
            ->appends(['q' => $q]);
        
        $archivos = Archivo::select('archivos.id','archivos.nombre','archivos.slug','posts.slug as post_slug')
            ->join('posts', 'archivos.post_id', '=', 'posts.id')
            ->where('archivos.nombre', 'like', "%$q%")
            ->paginate(10, ['*'], 'archivos_page')
            ->appends(['q' => $q]);
        
        $secciones = Section::where(function($query) use ($q) {
                $query->where('titulo', 'like', "$q%")
                      ->orWhere('etiquetas', 'like', "$q%");
            })
            ->paginate(10, ['*'], 'secciones_page')
            ->appends(['q' => $q]);

        return view('search.results', compact('q', 'noticias', 'servicios', 'paginas', 'archivos', 'secciones'));
    }

}
