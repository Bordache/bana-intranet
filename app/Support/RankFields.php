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

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
                'history_rank.required' => 'Ce champ est obligatoire.',
                'history_rank.*.required' => 'Ce champ est obligatoire.',
                'history_rank.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'history_rank.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'history_promotion_date.required' => 'Ce champ est obligatoire.',
                'history_promotion_date.*.required' => 'Ce champ est obligatoire.',
                'history_promotion_date.*.date' => 'Ce champ doit être une date valide.',
                'history_rank_reference.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'history_rank_reference.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
