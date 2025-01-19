<?php

namespace App\Support;

class HonoraryFields
{
    public static function getFields(): array
    {
        return [
            'honorary_title' => 'required|array',
            'honorary_promotion' => 'required|array',
            'honorary_reference' => 'nullable|array',
            'honorary_title.*' => 'required|string|max:255',
            'honorary_promotion.*' => 'required|string|max:255',
            'honorary_reference.*' => 'nullable|string|max:255',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
