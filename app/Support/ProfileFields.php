<?php

namespace App\Support;

class ProfileFields
{
    public static function getFields(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'firstname' => [
                'nullable',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255'
            ],
            'gender' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'national_id' => 'required|numeric|digits:12|unique:profiles,national_id',
            'issue_date' => 'nullable|date',
            'issue_place' => 'nullable|string|max:255',
            'duplicate_date' => 'nullable|date',
            'duplicate_place' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:255',
            'size' => 'nullable|integer|min:150',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'fallback_address' => 'nullable|string|max:255',
            'driver_license' => 'nullable|string|max:255',
            'practiced_sport' => 'nullable|string',
            'hobbies' => 'nullable|string',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
