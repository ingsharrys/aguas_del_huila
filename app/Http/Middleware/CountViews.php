<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CountViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Evitar procesar en respuestas de error (4xx, 5xx) o si la ruta viene vacía
        if (!$response->isSuccessful()) {
            return $response;
        }

        $routeName = $request->path();

        if (empty($routeName)) {
            return $response;
        }

        // 1. Truncar la ruta a un máximo seguro (ej. 700 o 250 caracteres según el tamaño de tu columna)
        $truncatedRoute = Str::limit($routeName, 255, '');

        try {
            // 2. Usar DB::transaction para manejar posibles Deadlocks de manera transparente
            DB::transaction(function () use ($truncatedRoute, $request) {
                // 3. Opcional: Usar upsert o mantienes updateOrInsert dentro del retry loop de la transacción
                DB::table('views')->updateOrInsert(
                    [
                        'route' => $truncatedRoute,
                        'ip'    => $request->ip(),
                        'date'  => now()->toDateString(),
                    ],
                    [
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }, 3); // Intentará hasta 3 veces automáticamente en caso de Deadlock
        } catch (\Throwable $e) {
            // Capturar la excepción para que un fallo de métricas NO caiga la petición del usuario
            Log::warning('Error al registrar métrica de vista: ' . $e->getMessage());
        }

        return $response;
    }
}