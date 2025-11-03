<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $postsPadres = Post::whereNull('parent_id')->pluck('nombre', 'id');
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
        $postsPadres = Post::whereNull('parent_id')
            ->where('id', '!=', $post->id)
            ->pluck('nombre', 'id');

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
}
