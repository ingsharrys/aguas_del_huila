<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::with('autor')->latest()->paginate(10);
        return view('noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'imagen_portada' => 'nullable|image|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen_portada')) {
            $rutaImagen = $request->file('imagen_portada')->store('noticias', 'public');
        }

        Noticia::create([
            'titulo' => $request->titulo,
            'slug' => Str::slug($request->titulo),
            'contenido' => $request->contenido,
            'imagen_portada' => $rutaImagen,
            'user_id' => Auth::id(),
            'publicado' => true
        ]);

        return redirect()->route('noticias.index')->with('success', 'Noticia creada correctamente.');
    }

    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
        ]);

        $noticia->update($request->all());

        return redirect()->route('noticias.index')->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Noticia eliminada.');
    }
}
