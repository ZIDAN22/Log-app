<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        $allowedRoles = preg_split('/[\|,]+/', $roles, -1, PREG_SPLIT_NO_EMPTY);

        if (! in_array($user->role, $allowedRoles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
