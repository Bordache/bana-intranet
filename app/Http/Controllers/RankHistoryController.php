<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\RankHistory;
use Illuminate\Http\Request;

class RankHistoryController extends Controller
{
    public function index(Profile $profile)
    {
        $rankHistories = $profile->rankHistories;
        return view('rank_histories.index', compact('profile', 'rankHistories'));
    }

    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'history_rank' => 'required|string|max:255',
            'history_promotion_date' => 'required|date',
            'history_rank_reference' => 'string|max:255',
        ]);

        $profile->rankHistories()->create($validated);
        return redirect()->route('rank_histories.index', $profile->id)->with('success', 'Grade ajouté avec succès.');
    }

    public function destroy(Profile $profile, $id)
    {
        $rankHistory = $profile->rankHistories()->findOrFail($id);
        $rankHistory->delete();
        return redirect()->route('rank_histories.index', $profile->id)->with('success', 'Grade supprimé avec succès.');
    }
}
