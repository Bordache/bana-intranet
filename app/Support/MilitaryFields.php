<?php

namespace App\Support;

class MilitaryFields
{
    public static function getFields(): array
    {
        return [
            'army' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'position_date' => 'nullable|date',
            'position_reference' => 'nullable|string|max:255',
            'military_registration_number' => 'required|string|max:6',
            'military_id_card_number' => 'nullable|string|size:6',
            'finance_registration_number' => 'nullable|string|max:255',
            'recruitment_origin' => 'nullable|string|max:255',
            'recruitment_promotion' => 'nullable|string|max:255',
            'service_entry_date' => 'required|date',
            'corps_assignment' => 'required|string|max:255',
            'unit_id' => 'required|integer|exists:units,id',
            'rank_id' => 'required|integer|exists:ranks,id',
            'rank_date' => 'nullable|date',
            'current_function' => 'nullable|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'exact_assignment' => 'nullable|string|max:255',
            'interruption_start_date' => 'nullable|date',
            'interruption_end_date' => 'nullable|date',
            'military_status' => 'nullable|string|max:255',
            'military_status_reference' => 'nullable|string|max:255',
            'military_driver_license' => 'nullable|string|max:255',
            'other_information' => 'nullable|string',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
