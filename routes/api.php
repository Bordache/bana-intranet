<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/api/check-national-id/{national_id}', function ($national_id) {
    $exists = Profile::where('national_id', $national_id)->exists();
    return response()->json(['isUnique' => !$exists]);
});
