<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ChildrenDetail;
use Illuminate\Http\Request;

class ChildrenDetailController extends Controller
{
    public function index(Profile $profile)
    {
        $childrenDetails = $profile->childrenDetails;
        return view('children_details.index', compact('profile', 'childrenDetails'));
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'child_full_name' => 'required|string|max:255',
            'child_birth_date' => 'required|date',
            'child_birth_place' => 'nullable|string|max:255',
            'child_gender' => 'required|string|max:50',
            'child_status' => 'nullable|string|max:255',
        ]);

        $profile->childrenDetails()->create($validated);
        return redirect()->route('children_details.index', $profile->id)->with('success', 'Enfant ajouté avec succès.');
    }

    public function destroy(Profile $profile, $id)
    {
        $child = $profile->childrenDetails()->findOrFail($id);
        $child->delete();
        return redirect()->route('children_details.index', $profile->id)->with('success', 'Enfant supprimé avec succès.');
    }
}
