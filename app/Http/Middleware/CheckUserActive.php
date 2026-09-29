<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserActive
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        if (!$user->estaActivo()) {

            auth()->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'username' => 'Su usuario se encuentra desactivado y no puede continuar en el sistema.',
                ]);
        }

        return $next($request);
    }
}