<?php

namespace App\Support;

class SpouseFields
{
    public static function getFields(): array
    {
        return [
           'spouse_name' => 'required|array',
            'spouse_maiden_name' => 'nullable|array',
            'spouse_firstname' => 'nullable|array',
            'spouse_birth_date' => 'nullable|array',
            'spouse_birth_place' => 'nullable|array',
            'spouse_profession' => 'nullable|array',
            'marriage_authorization' => 'nullable|array',
            'spouse_name.*' => [
                'required',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'spouse_maiden_name.*' => [
                'nullable',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'spouse_firstname.*' => [
                'nullable',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'spouse_birth_date.*' => 'nullable|date',
            'spouse_birth_place.*' => 'nullable|string|max:255',
            'spouse_profession.*' => 'nullable|string|max:255',
            'marriage_authorization.*' => 'nullable|string|max:255',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
