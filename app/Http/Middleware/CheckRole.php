<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @param  string|null  $domain
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role, $domain = null): Response
    {
        $user = Auth::user();

        if($user->isSuperAdmin()) {
            return $next($request);
        }

        if ($domain) {
            if (!$user || (!$user->hasRole($role, $domain) && !$user->isSuperAdmin())) {
                abort(403, 'Accès refusé : Vous n\'avez pas la permission de voir cette page');
            }
        } else {
            if (!$user || (!$user->hasRole($role) && !$user->isSuperAdmin())) {
                abort(403, 'Accès refusé : Vous n\'avez pas la permission de voir cette page');
            }
        }

        return $next($request);
    }
}
