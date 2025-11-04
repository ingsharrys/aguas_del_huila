<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        $query = Noticia::query()->with('categoria', 'autor');

        // Filtro por título o contenido
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('titulo', 'like', "%{$buscar}%");
            });
        }

        // Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Filtro por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        } elseif ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        } elseif ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        $noticias = $query->orderBy('created_at', 'desc')->paginate(10);

        $categorias = Categoria::orderBy('nombre')->get();
        
        return view('noticias.index', compact('noticias', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('noticias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen_portada' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Guardamos la imagen si se sube
        $rutaImagen = null;
        if ($request->hasFile('imagen_portada')) {
            $rutaImagen = $request->file('imagen_portada')->store('noticias', 'public');
        }

        // Creamos el slug del título
        $slug = Str::slug($request->titulo);

        // Verificamos si ya existe otro slug igual (para evitar duplicados)
        $contador = Noticia::where('slug', $slug)->count();
        if ($contador > 0) {
            $slug .= '-' . ($contador + 1);
        }

        // Creamos la noticia
        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->slug = $slug;
        $noticia->contenido = $request->contenido;
        $noticia->categoria_id = $request->categoria_id;
        $noticia->user_id = Auth::id(); // guarda el id del usuario logueado
        $noticia->imagen_portada = $rutaImagen;
        $noticia->save();

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Noticia creada correctamente');
        return redirect()->route('noticias.index');
    }

    public function edit(Noticia $noticia)
    {
        // Traemos todas las categorías para el select
        $categorias = Categoria::all();

        return view('noticias.edit', compact('noticia', 'categorias'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen_portada' => 'nullable|image|max:2048',
        ]);

        $noticia->titulo = $validated['titulo'];
        $noticia->slug = Str::slug($validated['titulo']);
        $noticia->contenido = $validated['contenido'];
        $noticia->categoria_id = $validated['categoria_id'] ?? null;

        // Si se sube una nueva imagen, eliminar la anterior y guardar la nueva
        if ($request->hasFile('imagen_portada')) {
            if ($noticia->imagen_portada) {
                Storage::delete('public/' . $noticia->imagen_portada);
            }

            $imagen = $request->file('imagen_portada')->store('noticias', 'public');
            $noticia->imagen_portada = $imagen;
        }

        $noticia->save();

        session()->flash('success', 'Noticia actualizada correctamente');
        return redirect()->route('noticias.index');
    }

    public function destroy(Noticia $noticia)
    {
        // Verificar si existe una imagen asociada y eliminarla del almacenamiento
        if ($noticia->imagen_portada && Storage::disk('public')->exists($noticia->imagen_portada)) {
            Storage::disk('public')->delete($noticia->imagen_portada);
        }

        // Eliminar la noticia de la base de datos
        $noticia->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'Noticia eliminada correctamente');
        return redirect()->route('noticias.index');
    }

    // Vista publica general de las noticias
    public function blog()
    {
        // Obtener noticias activas, ordenadas de más reciente a más antigua
        $noticias = Noticia::where('publicado', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12); // número de noticias por página

        return view('noticias.blog', compact('noticias'));
    }

    // Vista publica individual de las noticias
    public function article($slug, $id)
    {
        // Buscar la noticia por ID
        $noticia = Noticia::findOrFail($id);

        // Validar que el slug coincida (para evitar duplicados o URL incorrectas)
        if ($noticia->slug !== $slug) {
            return redirect()->route('noticias.article', ['slug' => $noticia->slug, 'id' => $noticia->id]);
        }

        // Obtener noticias relacionadas (por ejemplo, las 3 más recientes distintas de la actual)
        $relacionadas = Noticia::where('id', '!=', $id)
            ->where('publicado', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('noticias.article', compact('noticia', 'relacionadas'));
    }

}
