<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            // Guarda la imagen en "storage/app/public/noticias"
            $path = $request->file('file')->store('noticias', 'public');

            // Retorna la URL pública para TinyMCE
            return response()->json([
                'location' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'No se subió ningún archivo'], 400);
    }
}