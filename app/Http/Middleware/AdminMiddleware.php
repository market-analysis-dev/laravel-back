<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role_id === null) {
            throw new UnauthorizedException('Unauthorized. Only admins can access this route.', 401);
        }
        
        return $next($request);
    }
}