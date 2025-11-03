<?php

namespace App\Http\Controllers;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $query = Servicio::query();

        // Filtro por título o contenido
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%");
            });
        }

        $servicios = $query->orderBy('id', 'asc')->paginate(10);
        
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'imagen_portada' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Guardamos el icono si se sube
        $rutaIcono = null;
        if ($request->hasFile('icono')) {
            $rutaIcono = $request->file('icono')->store('servicios/iconos', 'public');
        }

        // Guardamos la imagen si se sube
        $rutaImagen = null;
        if ($request->hasFile('imagen_portada')) {
            $rutaImagen = $request->file('imagen_portada')->store('servicios', 'public');
        }

        // Creamos el slug del nombre
        $slug = Str::slug($request->nombre);

        // Verificamos si ya existe otro slug igual (para evitar duplicados)
        $contador = Servicio::where('slug', $slug)->count();
        if ($contador > 0) {
            $slug .= '-' . ($contador + 1);
        }

        // Creamos la servicio
        $servicio = new Servicio();
        $servicio->nombre = $request->nombre;
        $servicio->slug = $slug;
        $servicio->titulo = $request->titulo;
        $servicio->contenido = $request->contenido;
        $servicio->icono = $rutaIcono;
        $servicio->imagen_portada = $rutaImagen;
        $servicio->save();

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Servicio creado correctamente');
        return redirect()->route('servicios.index');
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'contenido' => 'required|string',
            'titulo' => 'required|string|max:255',
            'icono' => 'nullable|image|max:2048',
            'imagen_portada' => 'nullable|image|max:2048',
        ]);

        $servicio->titulo = $validated['titulo'];
        $servicio->slug = Str::slug($validated['titulo']);
        $servicio->contenido = $validated['contenido'];
        $servicio->nombre = $validated['nombre'];

        // Si se sube una nueva icono, eliminar la anterior y guardar la nueva
        if ($request->hasFile('icono')) {
            if ($servicio->icono) {
                Storage::delete('public/' . $servicio->icono);
            }

            $imagenIcon = $request->file('icono')->store('servicios/iconos', 'public');
            $servicio->icono = $imagenIcon;
        }

        // Si se sube una nueva imagen, eliminar la anterior y guardar la nueva
        if ($request->hasFile('imagen_portada')) {
            if ($servicio->imagen_portada) {
                Storage::delete('public/' . $servicio->imagen_portada);
            }

            $imagen = $request->file('imagen_portada')->store('servicios', 'public');
            $servicio->imagen_portada = $imagen;
        }

        $servicio->save();

        session()->flash('success', 'Servicio actualizado correctamente');
        return redirect()->route('servicios.index');
    }

    public function destroy(Servicio $servicio)
    {
        // Verificar si existe una icono asociada y eliminarla del almacenamiento
        if ($servicio->icono && Storage::disk('public')->exists($servicio->icono)) {
            Storage::disk('public')->delete($servicio->icono);
        }
        // Verificar si existe una imagen asociada y eliminarla del almacenamiento
        if ($servicio->imagen_portada && Storage::disk('public')->exists($servicio->imagen_portada)) {
            Storage::disk('public')->delete($servicio->imagen_portada);
        }

        // Eliminar la noticia de la base de datos
        $servicio->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'Servicio eliminada correctamente');
        return redirect()->route('servicios.index');
    }

}
