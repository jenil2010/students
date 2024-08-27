<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $module): Response
    {
        if (auth()->user()->Role_id != 1 && !$request->user()->hasRolePermission($module)) {
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
