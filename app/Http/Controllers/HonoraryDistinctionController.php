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

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'promotion' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
        ]);

        $profile->honoraryDistinctions()->create($validated);
        return redirect()->route('honorary_distinctions.index', $profile->id)->with('success', 'Distinction ajoutée avec succès.');
    }

    public function destroy(Profile $profile, $id)
    {
        $distinction = $profile->honoraryDistinctions()->findOrFail($id);
        $distinction->delete();
        return redirect()->route('honorary_distinctions.index', $profile->id)->with('success', 'Distinction supprimée avec succès.');
    }
}
