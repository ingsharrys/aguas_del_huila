<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

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

        $routeName = $request->path();

        if (!$routeName) {
            return $response;
        }

        DB::table('views')->updateOrInsert(
            [
                'route' => $routeName,
                'ip' => $request->ip(),
                'date' => now()->toDateString(),
            ],
            [
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return $response;
    }
}
