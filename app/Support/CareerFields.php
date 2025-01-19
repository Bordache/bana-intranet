<?php

namespace App\Support;

class CareerFields
{
    public static function getFields(): array
    {
        return [
           'company_name' => 'required|array',
            'job_title' => 'required|array',
            'start_date' => 'required|array',
            'end_date' => 'nullable|array',
            'description' => 'nullable|array',
            'company_name.*' => 'required|string|max:255',
            'job_title.*' => 'required|string|max:255',
            'start_date.*' => 'required|date',
            'end_date.*' => 'nullable|date',
            'description.*' => 'nullable|string',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
