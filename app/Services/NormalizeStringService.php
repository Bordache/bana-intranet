<?php

namespace App\Services;
use Illuminate\Support\Str;

class NormalizeStringService
{
    private function normalizeString(string $string): string
    {
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $string = preg_replace('/[^a-zA-Z0-9.]/', '', $string);

        return strtolower($string);
    }
}
