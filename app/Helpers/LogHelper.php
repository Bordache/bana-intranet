<?php
namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Request;

class LogHelper
{
    public static function logAction($userId, $eventName, $description = null, $domainId = null)
    {
        Log::create([
            'user_id' => $userId,
            'domain_id' => $domainId,
            'event_name' => $eventName,
            'description' => $description,
            'ip_address' => Request::ip(),
        ]);
    }
}
