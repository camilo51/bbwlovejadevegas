<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (auth()->check()) {
            // Verificar si el usuario tiene el rol correcto
            if (auth()->user()->rol == 1) {
                return $next($request);
            }
        }

        // Redirigir si el usuario no está autenticado o no tiene el rol correcto
        return redirect()->route('main');
    }
}
