<?php

namespace App\Support;

class SchoolFields
{
    public static function getFields(): array
    {
        return [
            'school_name' => 'required|array',
            'school_name.*' => 'required|string|max:255',
            'duration' => 'required|array',
            'duration.*' => 'required|string|max:255',
            'diploma' => 'nullable|array',
            'diploma.*' => 'nullable|string',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
