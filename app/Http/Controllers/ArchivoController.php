<?php

namespace App\Http\Controllers;

use App\Support\ArchivoSeguro;
use App\Models\Post;
use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\ArchivoImportService;
use ZipArchive;

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
            'archivo' => 'required|file|max:40960|extensions:' . implode(',', ArchivoSeguro::DOCUMENTOS_INSTITUCIONALES), // máx 40MB
            'comentarios' => 'nullable|boolean',
            'inicio' => 'required_if:comentarios,1|nullable|date',
            'fin' => 'nullable|date|after_or_equal:inicio',
        ], [
                'archivo.max' => 'El documento no debe superar los 40 MB.',
            ]);

        $slug = Str::slug($request->nombre);
        if (Archivo::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        // Obtener año actual
        $year = now()->format('Y');

        // Obtener la extensión del archivo
        $extension = ArchivoSeguro::extension($request->file('archivo'), ArchivoSeguro::DOCUMENTOS_INSTITUCIONALES);

        // Definir el nombre final del archivo
        $filename = $slug . '.' . $extension;

        // Guardar en la carpeta 'posts/archivos/AÑO/'
        $ruta = $request->file('archivo')->storeAs("posts/archivos/{$year}", $filename, 'public');

        Archivo::create([
            'nombre' => $request->nombre,
            'slug' => $slug,
            'archivo' => $ruta,
            'post_id' => $request->post_id,
            'comentarios' => $request->boolean('comentarios'),
            'inicio' => $request->boolean('comentarios')
                ? $request->inicio
                : null,
            'fin' => $request->boolean('comentarios')
                ? $request->fin
                : null,
        ]);

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Archivo creado correctamente');
        return redirect()->route('archivos.index');
    }

    /**
     * Eliminar un archivo
     */
    public function destroy(Archivo $archivo)
    {
        if (Storage::disk('public')->exists($archivo->archivo)) {
            Storage::disk('public')->delete($archivo->archivo);
        }

        $archivo->delete();

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Archivo eliminado correctamente');
        return redirect()->route('archivos.index');
    }

    /**
     * Mostrar formulario.
     */
    public function importarForm()
    {
        return view('archivos.importar');
    }

    /**
     * Procesar importación.
     */
    public function importar(Request $request, ArchivoImportService $importador)
    {
        $request->validate([
            'zip' => [
                'required',
                'file',
                'mimes:zip',
                'max:204800' //200 MB
            ]
        ]);

        $resultado = $importador->importar(
            $request->file('zip')
        );

        return back()->with($resultado);

    }
}
