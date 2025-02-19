<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$params)
    {
        $user = Auth::user();

        if($user->isSuperAdmin()) {
            return $next($request);
        }

        if (!$user) {
            abort(403, 'Accès refusé : utilisateur non authentifié.');
        }

        if (count($params) < 2) {
            abort(400, 'Paramètres insuffisants pour CheckPermission.');
        }

        [$permissions, $domain, $object] = array_pad($params, 3, null);

        // Séparer les permissions si plusieurs sont fournies avec "|"
        $permissionList = explode('|', $permissions);

        // Vérifier si l'utilisateur a au moins UNE des permissions
        foreach ($permissionList as $permission) {
            if ($user->hasPermission($permission, $domain, $object)) {
                return $next($request);
            }
        }

        abort(403, 'Accès refusé : Vous n\'avez pas la permission de voir cette page');
    }

}
