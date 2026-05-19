<?php

namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class CheckRole
{
    /**
     * Uso nas rotas: middleware('role:aqv') ou middleware('role:aqv,portaria')
     */
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
 
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Você não tem permissão para acessar esta área.');
        }
 
        return $next($request);
    }
}