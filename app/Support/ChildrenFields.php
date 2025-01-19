<?php

namespace App\Support;

class ChildrenFields
{
    public static function getFields(): array
    {
        return [
            'child_full_name' => 'required|array',
            'child_full_name.*' => [
                'required',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'child_birth_date' => 'required|array',
            'child_birth_date.*' => 'required|date',
            'child_birth_place' => 'nullable|array',
            'child_birth_place.*' => 'nullable|string|max:255',
            'child_gender' => 'required|array',
            'child_gender.*' => 'required|in:M,F',
            'child_status' => 'nullable|array',
            'child_status.*' => 'nullable|in:LG,RE,AD,NL',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
