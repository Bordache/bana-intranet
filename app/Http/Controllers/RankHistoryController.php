<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\RankHistory;
use Illuminate\Http\Request;

class RankHistoryController extends Controller
{
    public function index(Profile $profile)
    {
        //
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
            'history_rank' => 'required|string|max:255',
            'history_promotion_date' => 'required|date',
            'history_rank_reference' => 'string|max:255',
        ]);

        $profile->rankHistories()->create($validated);
        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'rank_histories',
        ])->with('success', 'Grade ajouté avec succès.');
    }

    public function update(Request $request, Profile $profile, $id)
    {
        $rankHistory = $profile->rankHistories()->findOrFail($id);
        $validated = $request->validate([
            'history_rank' => 'required|string|max:255',
            'history_promotion_date' => 'required|date',
            'history_rank_reference' => 'nullable|string|max:255',
        ]);

        $rankHistory->update($validated);
        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'rank_histories',
        ])->with('success', 'Grade mis à jour avec succès.');
    }

    public function destroy(Profile $profile, $id)
    {
        $rankHistory = $profile->rankHistories()->findOrFail($id);
        $rankHistory->delete();

        return redirect()->route('personnel.show', [
            'id' => $profile->id,
            'tab' => 'rank_histories',
        ])->with('success', 'Grade supprimé avec succès');
    }
}
