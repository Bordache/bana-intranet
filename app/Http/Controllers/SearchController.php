<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function customSearch(Request $request)
    {
        $query = Profile::with([
            'militaryDetail',
            'academicPaths',
            'militaryPaths',
            'honoraryDistinctions',
            'militaryCampaigns',
        ]);

        // Filtrage par rang
        if ($request->filled('rank_id')) {
            $query->whereHas('militaryDetail', function ($q) use ($request) {
                $q->where('rank_id', $request->rank_id);
            });
        }

        // Filtrage par unité
        if ($request->filled('unit_id')) {
            $query->whereHas('militaryDetail', function ($q) use ($request) {
                $q->where('unit_id', $request->unit_id);
            });
        }

        // Filtrage par date d'entrée en service
        if ($request->filled('service_entry_start') && $request->filled('service_entry_end')) {
            $query->whereHas('militaryDetail', function ($q) use ($request) {
                $q->whereBetween('service_entry_date', [
                    $request->service_entry_start,
                    $request->service_entry_end,
                ]);
            });
        }

        // Filtrage par diplôme académique
        if ($request->filled('academic_diploma')) {
            $query->whereHas('academicPaths', function ($q) use ($request) {
                $q->where('diploma', 'like', '%' . $request->academic_diploma . '%');
            });
        }

        // Filtrage par diplôme militaire
        if ($request->filled('military_diploma')) {
            $query->whereHas('militaryPaths', function ($q) use ($request) {
                $q->where('academy_diploma', 'like', '%' . $request->military_diploma . '%');
            });
        }

        // Filtrage par distinctions honorifiques
        if ($request->filled('honorary_title')) {
            $query->whereHas('honoraryDistinctions', function ($q) use ($request) {
                $q->where('honorary_title', 'like', '%' . $request->honorary_title . '%');
            });
        }

        // Exécute la requête et retourne les résultats
        $results = $query->get();

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }

}

