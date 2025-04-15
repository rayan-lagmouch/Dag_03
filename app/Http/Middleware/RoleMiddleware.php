<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user has the required role
        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Redirect or throw an exception if the user does not have the required role
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
