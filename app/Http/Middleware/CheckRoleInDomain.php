<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;

class CheckRoleInDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @param  string  $domain
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $domainName): Response
    {
        $user = Auth::user();

        if($user->isSuperAdmin()) {
            return $next($request);
        }

        if (!$user || (!$user->hasRoleInDomain($domainName) && !$user->isSuperAdmin())) {
            abort(403, 'Accès refusé : Vous n\'avez pas la permission de voir cette page');
        }
        return $next($request);
    }
}

