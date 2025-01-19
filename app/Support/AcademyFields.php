<?php

namespace App\Support;

class AcademyFields
{
    public static function getFields(): array
    {
        return [
            'academy_name' => 'required|array',
            'academy_name.*' => 'required|string|max:255',
            'academy_duration' => 'required|array',
            'academy_duration.*' => 'required|string|max:255',
            'academy_diploma' => 'nullable|array',
            'academy_diploma.*' => 'nullable|string',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
