<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user_role_slug = Str::slug(Auth::user()->role);
        $roles = array_map(function ($r) {
            return Str::slug($r);
        }, $roles);


        if (\in_array($user_role_slug, $roles)) {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
