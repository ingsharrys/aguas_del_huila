<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Noticia;
use App\Models\Servicio;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('activo', 1)->orderBy('id', 'desc')->get();

        // Video de YouTube
        $videosYouTube = Cache::remember(
            'youtube.rss.latest',
            now()->addHours(6),
            function () {
                $response = Http::timeout(10)->get(
                    'http://www.youtube.com/feeds/videos.xml',
                    [
                        'channel_id' => 'UC80b0aMB5h9LaSGr9w0O1Lw'
                    ]
                );
    
                if (!$response->successful()) {
                    return [];
                }
    
                $xml = simplexml_load_string($response->body());
                $videos = [];
    
                foreach ($xml->entry as $entry) {
                    $videos[] = [
                        'videoId' => (string) $entry->children('yt', true)->videoId,
                        'title'   => (string) $entry->title,
                    ];
                }
    
                return array_slice($videos, 0, 6);
            }
        );

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

        return view('participacion.participacion', compact('noticias'));
    }

}
