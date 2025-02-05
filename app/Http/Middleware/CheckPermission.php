<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission, $domain, $object = null)
    {
        $user = Auth::user();

        if (!$user || (!$user->hasPermission($permission, $domain, $object) && !$user->isSuperAdmin())) { // Ex : CheckPermission(view,rh,personnel)
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}

