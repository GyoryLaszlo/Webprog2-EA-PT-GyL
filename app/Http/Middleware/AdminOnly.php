<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Nincs bejelentkezve vagy nem admin → tiltás
        if (!$user || !$user->is_admin) {
            abort(403, 'Csak admin érheti el ezt az oldalt.');
        }

        return $next($request);
    }
}
