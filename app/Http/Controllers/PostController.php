<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Archivo;
use App\Models\Comentario;
use App\Models\DepartamentoCol;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Mostrar listado de posts
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $posts = Post::query()
            ->with('parent')
            ->when($buscar, fn($q) =>
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('slug', 'like', "%{$buscar}%")
            )
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $postsPadres = Post::orderBy('id', 'desc')->get();
        return view('posts.create', compact('postsPadres'));
    }

    /**
     * Guardar un nuevo post
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'parent_id' => 'nullable|exists:posts,id',
        ]);

        $slug = Str::slug($request->nombre);
        if (Post::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        Post::create([
            'nombre' => $request->nombre,
            'slug' => $slug,
            'contenido' => $request->contenido,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post creado correctamente.');
    }

    /**
     * Editar un post existente
     */
    public function edit(Post $post)
    {
        $postsPadres = Post::where('id', '!=', $post->id)->get();

        return view('posts.edit', compact('post', 'postsPadres'));
    }

    /**
     * Actualizar un post existente
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'parent_id' => 'nullable|exists:posts,id',
        ]);

        $post->update([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'contenido' => $request->contenido,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post actualizado correctamente.');
    }

    /**
     * Eliminar un post
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post eliminado correctamente.');
    }

    // Vista publica individual de los posts PDA
    public function show($slug = null)
    {
        // Obtener posts de PDA
        $pda = Post::where('id', 13)->first();
        // Obtener hijos del posts de PDA
        $pdaPosts = Post::where('parent_id', 13)->orderBy('nombre')->get();
        // Determinar tab activo
        $activeTab = $slug
            ? Post::where('slug', $slug)->firstOrFail()
            : $pda;

        // Obtener archivos del padre y los hijos
        $archivos = Archivo::whereIn('post_id', 
            $pdaPosts->pluck('id')->push($pda->id)
        )
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('post_id'); // Agrupa los archivos por post_id 👈

        return view('posts.show', compact('pda', 'pdaPosts', 'activeTab', 'archivos'));
    }

    // Vista publica general de los posts
    public function download()
    {
        // Obtener posts padres, ordenadas de más reciente a más antigua
        $posts = Post::where('parent_id', null)
            ->orderBy('created_at', 'desc')
            ->paginate(12); // número de posts por página

        return view('posts.download', compact('posts'));
    }

    // Vista publica individual de los posts
    public function file(Request $request, $path)
    {
        // separar slugs
        $segments = explode('/', $path);
    
        // último slug es el post actual
        $slug = end($segments);
    
        $post = Post::where('slug', $slug)->firstOrFail();
    
        // hijos
        $hijos = $post->children()
            ->orderBy('created_at', 'desc')
            ->get();
    
        $archivos = Archivo::where('post_id', $post->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);

        // Filtrar archivos si es el post de sistema de normas
        $archivosNormas = collect();

        if ($post->slug == 'sistema-de-normas') {

            // IDs de los hijos (Acuerdos, Resoluciones, etc.)
            $post->load('children.children.children');

            $idsPosts = collect([$post->id])
                ->merge($post->obtenerDescendientesIds())
                ->unique();

            $queryNormas = Archivo::whereIn(
                'post_id',
                $idsPosts
            );

            // Si escogió un tipo
            if ($request->filled('tipo')) {

                $tipo = Post::with('children.children.children')
                    ->findOrFail($request->tipo);

                $idsTipo = collect([$tipo->id])
                    ->merge($tipo->obtenerDescendientesIds());

                $queryNormas->whereIn('post_id', $idsTipo->unique());

            } else {

                // Mostrar todos los tipos
                $queryNormas->whereIn('post_id', $idsPosts);

            }

            // Buscar por nombre
            if ($request->filled('nombre')) {

                $queryNormas->where(
                    'nombre',
                    'like',
                    '%' . $request->nombre . '%'
                );

            }

            $archivosNormas = $queryNormas
                ->latest()
                ->paginate(15)
                ->withQueryString();
        }

        if ($request->ajax()) {

            $lista = $post->slug == 'sistema-de-normas'
                ? $archivosNormas
                : $archivos;

            return view('partials.archivos', [
                'archivos' => $lista
            ]);
        }

        // Archivos disponibles para comentarios
        $comentariosAbiertos = collect();
        $comentariosCerrados = collect();

        if ($post->slug == 'participacion-en-formulacion-de-politicas-publicas') {

            $post->load('children.children.children');

            $idsPosts = collect([$post->id])
                ->merge($post->obtenerDescendientesIds())
                ->unique();

            $hoy = now()->toDateString();

            $comentariosAbiertos = Archivo::whereIn('post_id', $idsPosts)
                ->where('comentarios', 1)
                ->whereDate('inicio', '<=', $hoy)
                ->where(function ($query) use ($hoy) {
                    $query->whereNull('fin')
                        ->orWhereDate('fin', '>=', $hoy);
                })
                ->orderBy('fin')
                ->get();

            $comentariosCerrados = Archivo::whereIn('post_id', $idsPosts)
                ->where('comentarios',1)
                ->whereDate('fin','<',$hoy)
                ->orderByDesc('fin')
                ->get();

        }
    
        // breadcrumb (padres)
        $breadcrumbs = [];
        $parent = $post;
    
        while ($parent) {
            array_unshift($breadcrumbs, $parent);
            $parent = $parent->parent;
        }

        $tiposNormas = collect();

        if ($post->slug == 'sistema-de-normas') {

            $tiposNormas = $post->children()
                ->orderBy('nombre')
                ->get();

        }
    
        return view('posts.file', compact(
            'post',
            'hijos',
            'archivos',
            'archivosNormas',
            'breadcrumbs',
            'tiposNormas',
            'comentariosAbiertos',
            'comentariosCerrados'
        ));
    }
    
    // Vista para mostrar los archivos
    public function document($postSlug, $archivoSlug)
    {
        $post = Post::where('slug', $postSlug)->firstOrFail();

        $breadcrumbs = [];

        $parent = $post;

        while ($parent) {

            array_unshift($breadcrumbs, $parent);

            $parent = $parent->parent;
        }

        $archivo = Archivo::where('slug', $archivoSlug)
            ->where('post_id', $post->id)
            ->firstOrFail();

        $comentarios = Comentario::with('departamento')
            ->where('archivo_id', $archivo->id)
            ->where('aprobado', 1)
            ->latest()
            ->paginate(10);

        $totalComentarios = Comentario::where('archivo_id',$archivo->id)
            ->where('aprobado',1)
            ->count();

        $puedeComentar = false;

        if(
            $archivo->comentarios &&
            Carbon::now()->between(
                Carbon::parse($archivo->inicio),
                Carbon::parse($archivo->fin)
            )
        ){
            $puedeComentar = true;
        }

        $departamentos = DepartamentoCol::where('estado', 1)
            ->orderBy('nombre')
            ->get();

        return view(
            'posts.document',
            compact(
                'post',
                'archivo',
                'breadcrumbs',
                'comentarios',
                'totalComentarios',
                'puedeComentar',
                'departamentos'
            )
        );
    }

    public function guardarComentario(Request $request, Archivo $archivo)
    {

        $request->validate([

            'identificacion'=>'required|max:20',

            'nombre'=>'required|string|max:3000',

            'departamento_id'=>'required|exists:departamentos_col,id',

            'comentario'=>'required|string|max:3000',

            'acepta_terminos'=>'accepted'

        ]);

        Comentario::create([

            'archivo_id'=>$archivo->id,

            'nombre'=>$request->nombre,

            'identificacion'=>$request->identificacion,

            'departamento_id'=>$request->departamento_id,

            'comentario'=>$request->comentario,

            'acepta_terminos'=>1,

            // pendiente de aprobación

            'aprobado'=>0

        ]);

        return back()->with(
            'success',
            'Su comentario fue enviado correctamente y será publicado una vez sea revisado.'
        );

    }


}
