<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return response('Unauthorized.', 401);
        }

        $user = Auth::user();
        if ($user->roles()->where('name', $role)->exists()) {
            return $next($request);
        }

        return response('Unauthorized.', 403);
    }
}
