<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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

        return back()->with([
            'success' => 'Distinction mise à jour avec succès.',
            'tab' => 'honorary_distinctions',
        ]);
    }

    public function destroy(Profile $profile, $id)
    {
        $distinction = $profile->honoraryDistinctions()->findOrFail($id);
        $distinction->delete();

        return back()->with([
            'success' => 'Distinction supprimé avec succès.',
            'tab' => 'honorary_distinctions',
        ]);
    }

    public function destroyAll(Profile $profile)
    {
        $profile->honoraryDistinctions()->delete();

        return back()->with([
            'success' => 'Toutes les distinctions ont été supprimées avec succès.',
            'tab' => 'honorary_distinctions',
        ]);
    }

}
