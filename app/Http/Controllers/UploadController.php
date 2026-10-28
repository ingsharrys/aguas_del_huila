<?php

namespace App\Http\Controllers;

use App\Support\ArchivoSeguro;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Imágenes insertadas desde el editor TinyMCE (requiere sesión, ver routes/web.php).
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'extensions:jpg,jpeg,png,gif,webp', 'max:5120'],
        ], [
            'file.image'      => 'Solo se permiten imágenes.',
            'file.mimes'      => 'Solo se permiten imágenes JPG, PNG, GIF o WEBP.',
            'file.extensions' => 'Solo se permiten imágenes JPG, PNG, GIF o WEBP.',
            'file.max'        => 'La imagen no puede superar 5 MB.',
        ]);

        // Guarda la imagen en "storage/app/public/noticias" con nombre aleatorio
        $path = ArchivoSeguro::guardar($request->file('file'), 'noticias', ArchivoSeguro::IMAGENES);

        // Retorna la URL pública para TinyMCE
        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    }
}
