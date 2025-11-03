<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Categoria::query();

        // Filtro por título o contenido
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%");
            });
        }

        $categorias = $query->orderBy('id', 'asc')->paginate(10);
        
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // Creamos el slug del título
        $slug = Str::slug($request->nombre);

        // Verificamos si ya existe otro slug igual (para evitar duplicados)
        $contador = Categoria::where('slug', $slug)->count();
        if ($contador > 0) {
            $slug .= '-' . ($contador + 1);
        }

        // Creamos la noticia
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->slug = $slug;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Categoría creada correctamente');
        return redirect()->route('categorias.index');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $categoria->nombre = $validated['nombre'];
        $categoria->slug = Str::slug($validated['nombre']);
        $categoria->descripcion = $validated['descripcion'];

        $categoria->save();

        session()->flash('success', 'Categoria actualizada correctamente');
        return redirect()->route('categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        // Eliminar la categoria de la base de datos
        $categoria->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'Categoria eliminada correctamente');
        return redirect()->route('categorias.index');
    }
}
