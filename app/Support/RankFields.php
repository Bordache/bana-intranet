<?php

namespace App\Support;

class RankFields
{
    public static function getFields(): array
    {
        return [
           'history_rank' => 'required|array',
            'history_promotion_date' => 'required|array',
            'history_rank_reference' => 'nullable|array',
            'history_rank.*' => 'required|string|max:255',
            'history_promotion_date.*' => 'required|date',
            'history_rank_reference.*' => 'nullable|string|max:255',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
