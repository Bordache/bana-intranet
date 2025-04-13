<?php
namespace App\Http\Controllers;

use App\Models\RoleDomain;
use App\Models\Domain;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;

class RoleDomainController extends Controller
{
    public function index()
    {
        $domains = Domain::with('roles')->get(); // Charge les rôles par domaine

        return view('admin.roles.index', compact('domains'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'role_domain_id' => 'required|exists:role_domains,id',
            'domain_description' => 'required|string|max:255',
        ]);

        $roleDomain = RoleDomain::findOrFail($request->role_domain_id);
        $roleDomain->domain_description = $request->domain_description;
        $roleDomain->save();

        return redirect()->route('admin.roles.index')->with('success', 'Rôle mis à jour avec succès.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'role_domain_id' => 'required|exists:role_domains,id',
        ]);

        RoleDomain::destroy($request->role_domain_id);

        return redirect()->route('admin.roles.index')->with('success', 'Rôle supprimé avec succès.');
    }
}
