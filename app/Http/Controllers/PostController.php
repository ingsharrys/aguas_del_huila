<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Archivo;
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
    public function file($slug)
    {
        // Buscar el post padre
        $post = Post::where('slug', $slug)->firstOrFail();

        // Obtener los posts hijos
        $hijos = Post::where('parent_id', $post->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Obtener archivos asociados
        $archivos = Archivo::where('post_id', $post->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.file', compact('post', 'hijos', 'archivos'));
    }
}
