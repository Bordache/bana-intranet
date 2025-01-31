<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index($domainId = null)
    {
        $logs = $domainId ? Log::where('domain_id', $domainId)->with('user', 'domain')->latest()->paginate(20) : Log::with('user', 'domain')->latest()->paginate(20);

        return view('admin.logs.index', compact('logs'));
    }
}
