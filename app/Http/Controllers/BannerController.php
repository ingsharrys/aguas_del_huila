<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::query();

        // Filtro por título
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('titulo', 'like', "%{$buscar}%");
            });
        }

        $banners = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'boton' => 'nullable|string|max:255',
            'enlace' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'activo' => 'nullable|boolean',
        ]);

        // Guardamos la imagen si se sube
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('banners', 'public');
        }

        // Creamos la banner
        $banner = new Banner();
        $banner->titulo = $request->titulo;
        $banner->subtitulo = $request->subtitulo;
        $banner->boton = $request->boton;
        $banner->enlace = $request->enlace;
        $banner->imagen = $rutaImagen;
        $banner->save();

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Banner creado correctamente');
        return redirect()->route('banners.index');
    }

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'string',
            'boton' => 'string',
            'enlace' => 'string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'activo' => 'nullable|boolean',
        ]);

        $banner->titulo = $validated['titulo'];
        $banner->subtitulo = $validated['subtitulo'] ?? null;
        $banner->boton = $validated['boton'] ?? null;
        $banner->enlace = $validated['enlace'] ?? null;
        $banner->activo = $request->boolean('activo');

        // Si se sube una nueva imagen, eliminar la anterior y guardar la nueva
        if ($request->hasFile('imagen')) {
            if ($banner->imagen) {
                Storage::delete('public/' . $banner->imagen);
            }

            $imagen = $request->file('imagen')->store('banners', 'public');
            $banner->imagen = $imagen;
        }

        $banner->save();

        session()->flash('success', 'Banner actualizado correctamente');
        return redirect()->route('banners.index');
    }

    public function destroy(Banner $banner)
    {
        // Verificar si existe una imagen asociada y eliminarla del almacenamiento
        if ($banner->imagen && Storage::disk('public')->exists($banner->imagen)) {
            Storage::disk('public')->delete($banner->imagen);
        }

        // Eliminar la banner de la base de datos
        $banner->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'Banner eliminado correctamente');
        return redirect()->route('banners.index');
    }

}