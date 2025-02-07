<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function adminLogsIndex()
    {
        $search = null;
        $logs = Log::with('user', 'domain')
            ->latest()
            ->paginate(20);

        return view('admin.logs.index', compact('logs', 'search'));
    }

    public function personnelLogsIndex()
    {
        $search = null;
        $domainName = 'rh';
        $logs = Log::with('user', 'domain')
            ->whereHas('domain', function ($query) use ($domainName) {
                $query->where('name', $domainName);
            })
            ->latest()
            ->paginate(20);

        return view('personnel.logs.index', compact('logs', 'search'));
    }

    public function adminLogsSearch(Request $request)
    {
        $search = trim(strip_tags($request->input('search')));

        $logs = Log::with('user', 'domain')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('event_name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('ip_address', 'like', "%{$search}%")
                      ->orWhereHas('user', fn($q) => $q->where('username', 'like', "%{$search}%"))
                      ->orWhereHas('domain', fn($q) => $q->where('domain_description', 'like', "%{$search}%"));

                    // Vérifier si l'entrée correspond à une date sous forme "jour/mois" (ex: "31/01")
                    if (preg_match('/^(\d{1,2})\/(\d{1,2})$/', $search, $matches)) {
                        $day = $matches[1];
                        $month = $matches[2];
                        $q->orWhereRaw("DAY(created_at) = ? AND MONTH(created_at) = ?", [$day, $month]);
                    }
                    // Vérifier si l'entrée est un chiffre et rechercher dans created_at (jour, mois, année, heure...)
                    elseif (is_numeric($search)) {
                        $q->orWhereRaw("DAY(created_at) = ?", [$search])
                          ->orWhereRaw("MONTH(created_at) = ?", [$search])
                          ->orWhereRaw("YEAR(created_at) = ?", [$search])
                          ->orWhereRaw("HOUR(created_at) = ?", [$search])
                          ->orWhereRaw("MINUTE(created_at) = ?", [$search])
                          ->orWhereRaw("SECOND(created_at) = ?", [$search]);
                    }
                });
            })
            ->latest()->paginate(20)->appends($request->query());

        return view('admin.logs.index', compact('logs', 'search'));
    }



    public function personnelLogsSearch(Request $request)
    {
        $domainName = 'rh';
        $search = trim(strip_tags($request->input('search')));

        if (empty($search)) {
            return $this->personnelLogsIndex();
        } else {
            $logs = Log::with('user', 'domain')
            ->whereHas('domain', function ($query) use ($domainName) {
                $query->where('name', $domainName);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('created_at', 'like', "%{$search}%")
                    ->orWhere('event_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhereHas('user', fn($q) => $q->where('username', 'like', "%{$search}%"))
                    ->orWhereHas('domain', fn($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()->paginate(20)->appends($request->query());

        return view('personnel.logs.index', compact('logs', 'search'));
        }
    }
}
