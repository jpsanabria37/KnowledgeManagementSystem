<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirigir al dashboard correcto según el rol
                $user = Auth::user();
                
                if ($user->hasRole('admin')) {
                    return redirect('/regionales');
                } elseif ($user->hasRole('instructor')) {
                    return redirect('/instructor/dashboard');
                } elseif ($user->hasRole('aprendiz')) {
                    return redirect('/aprendiz/dashboard');
                }

                // Redirección por defecto si no tiene un rol específico
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
