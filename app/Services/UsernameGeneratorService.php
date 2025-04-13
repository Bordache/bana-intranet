<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\User;

class UsernameGeneratorService
{

    /**
     * Génère un username unique à partir du name et firstname.
     *
     * @param string $name
     * @param string $firstname
     * @return string
     */
    public function generateUniqueUsername(string $name, ?string $firstname): string
    {
        $firstname = $firstname ? explode(' ', $firstname)[0] : '';

        $name = $this->normalizeString($name);
        $firstname = $this->normalizeString($firstname);

        $baseUsername = $firstname ? $name . '.' . $firstname : $name;
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    private function normalizeString(string $string): string
    {
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $string = preg_replace('/[^a-zA-Z0-9.]/', '', $string);

        return strtolower($string);
    }
}
