<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    /**
     * Listar archivos asociados a un post
     */
    public function index(Request $request)
    {
        $query = Archivo::query();

        // Filtro por título o contenido
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%");
            });
        }

        $archivos = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('archivos.index', compact('archivos'));
    }

    /**
     * Mostrar formulario para subir un archivo
     */
    public function create(Request $request)
    {
        $posts = Post::all();
        $postSeleccionado = $request->get('post_id'); // si viene desde la vista de posts

        return view('archivos.create', compact('posts', 'postSeleccionado'));
    }

    /**
     * Guardar archivo en el sistema
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'post_id' => 'required|int',
            'archivo' => 'required|file|max:10240', // máx 10MB
        ]);

        $slug = Str::slug($request->nombre);
        if (Archivo::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        // Guardar archivo físicamente
        $ruta = $request->file('archivo')->store('posts/archivos', 'public');

        Archivo::create([
            'nombre' => $request->nombre,
            'slug' => $slug,
            'archivo' => $ruta,
            'post_id' => $request->post_id,
        ]);

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Archivo creado correctamente');
        return redirect()->route('archivos.index');
    }

    /**
     * Eliminar un archivo
     */
    public function destroy(Post $post, Archivo $archivo)
    {
        if (Storage::disk('public')->exists($archivo->archivo)) {
            Storage::disk('public')->delete($archivo->archivo);
        }

        $archivo->delete();

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Archivo eliminado correctamente');
        return redirect()->route('archivos.index');
    }
}
