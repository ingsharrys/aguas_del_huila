<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function index($carpeta = '')
    {
        $base = 'posts/gestion-de-calidad';

        $ruta = trim($base.'/'.$carpeta, '/');

        if (str_contains($carpeta, '..')) {
            abort(403);
        }

        if (!Storage::disk('public')->exists($ruta)) {
            abort(404);
        }

        $carpetas = Storage::disk('public')->directories($ruta);
        $archivos = Storage::disk('public')->files($ruta);

        return view('documentos.index', compact(
            'carpetas',
            'archivos',
            'carpeta'
        ));
    }
}