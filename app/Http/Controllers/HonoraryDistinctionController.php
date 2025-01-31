<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Helpers\LogHelper;
use App\Models\Domain;
use App\Models\HonoraryDistinction;
use Illuminate\Http\Request;

class HonoraryDistinctionController extends Controller
{
    public function index(Profile $profile)
    {
        $honoraryDistinctions = $profile->honoraryDistinctions;
        return view('honorary_distinctions.index', compact('profile', 'honoraryDistinctions'));
    }

    public function show(Profile $profile, $id)
    {
        //
    }

    public function edit(Profile $profile, $id)
    {
        //
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'honorary_title' => 'required|string|max:255',
            'honorary_promotion' => 'nullable|string|max:255',
            'honorary_reference' => 'nullable|string|max:255',
        ]);

        $profile->honoraryDistinctions()->create($validated);

        $domainId = Domain::where('name', 'rh')->value('id');

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Create_decoration',
            "Ajout de décoration {$request->honorary_title} de {$profile->name} {$profile->firstname}",
            $domainId
        );

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'honorary_distinctions',
        ])->with('success', 'Distinction ajoutée avec succès.');
    }

    public function update(Request $request, Profile $profile, $id)
    {
        $award = $profile->honoraryDistinctions()->findOrFail($id);
        $validated = $request->validate([
            'honorary_title' => 'required|string|max:255',
            'honorary_promotion' => 'nullable|string|max:255',
            'honorary_reference' => 'nullable|string|max:255',
        ]);

        $award->update($validated);

        $domainId = Domain::where('name', 'rh')->value('id');

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Update_decoration',
            "Mise à jour de décoration {$request->honorary_title} de {$profile->name} {$profile->firstname}",
            $domainId
        );

        return back()->with([
            'success' => 'Distinction mise à jour avec succès.',
            'tab' => 'honorary_distinctions',
        ]);
    }

    public function destroy(Profile $profile, $id)
    {
        $distinction = $profile->honoraryDistinctions()->findOrFail($id);
        $distinction->delete();

        $domainId = Domain::where('name', 'rh')->value('id');

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Delete_decoration',
            "Suppression de décoration {$distinction->honorary_title} de {$profile->name} {$profile->firstname}",
            $domainId
        );

        return back()->with([
            'success' => 'Distinction supprimé avec succès.',
            'tab' => 'honorary_distinctions',
        ]);
    }

    public function destroyAll(Profile $profile)
    {
        $profile->honoraryDistinctions()->delete();

        $domainId = Domain::where('name', 'rh')->value('id');

        // Log de l'action
        LogHelper::logAction(
            auth()->id(),
            'Delete_decoration',
            "Suppression de toutes les décorations de {$profile->name} {$profile->firstname}",
            $domainId
        );

        return back()->with([
            'success' => 'Toutes les distinctions ont été supprimées avec succès.',
            'tab' => 'honorary_distinctions',
        ]);
    }

}
