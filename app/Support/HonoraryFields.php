<?php

namespace App\Support;

class HonoraryFields
{
    public static function getFields(): array
    {
        return [
            'honorary_title' => 'required|array',
            'honorary_promotion' => 'nullable|array',
            'honorary_reference' => 'nullable|array',
            'honorary_title.*' => 'required|string|max:255',
            'honorary_promotion.*' => 'nullable|string|max:255',
            'honorary_reference.*' => 'nullable|string|max:255',
        ];
    }

     /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
                'honorary_title.required' => 'Ce champ est obligatoire.',
                'honorary_title.*.required' => 'Ce champ est obligatoire.',
                'honorary_title.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'honorary_title.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'honorary_promotion.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'honorary_promotion.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'honorary_reference.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'honorary_reference.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
