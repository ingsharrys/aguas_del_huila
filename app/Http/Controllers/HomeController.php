<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Http;
use App\Models\Noticia;
use App\Models\Servicio;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('activo', 1)->orderBy('id', 'desc')->get();

        // Video de YouTube
        $apiKey = env('YOUTUBE_API_KEY');
        $channelId = 'UC80b0aMB5h9LaSGr9w0O1Lw';
        /** Activar en produccion
        * $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
        *    'key' => $apiKey,
        *    'channelId' => $channelId,
        *   'part' => 'snippet',
        *    'order' => 'date',
        *    'maxResults' => 6,
        *]);
        */

        // Solo usar en prueba
        $response = Http::withoutVerifying()->get('https://www.googleapis.com/youtube/v3/search', [
            'key' => $apiKey,
            'channelId' => $channelId,
            'part' => 'snippet',
            'order' => 'date',
            'maxResults' => 6,
        ]);

        $videosYouTube = $response->json()['items'] ?? [];

        // Mostrar notiicas
        $noticias = Noticia::with('autor')
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();

        // Mostrar servicios
        $servicios = Servicio::get();

        return view('home', compact('banners', 'videosYouTube', 'noticias', 'servicios'));
    }

    public function blog()
    {

        // Mostrar notiicas
        $noticias = Noticia::with('autor')
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();

        return view('participacion', compact('noticias'));
    }

}
