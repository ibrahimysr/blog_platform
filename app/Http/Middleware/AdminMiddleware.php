<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user || !$user->getKey()) {
            return redirect()->route('login');
        }
        if (!$user->roles()->where('name', 'admin')->exists()) {
            abort(403);
        }
        return $next($request);
    }
}
