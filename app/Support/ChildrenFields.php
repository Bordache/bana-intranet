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
            'child_gender.*' => 'required|string|max:255',
            'child_status' => 'nullable|array',
            'child_status.*' => 'nullable|string|max:255',
        ];
    }

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
                'child_full_name.required' => 'Ce champ est obligatoire.',
                'child_full_name.*.required' => 'Ce champ est obligatoire.',
                'child_full_name.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'child_full_name.*.regex' => 'Ce champ contient des caractères non valides.',
                'child_full_name.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'child_birth_date.required' => 'Ce champ est obligatoire.',
                'child_birth_date.*.required' => 'Ce champ est obligatoire.',
                'child_birth_date.*.date' => 'Ce champ doit être une date valide.',
                'child_birth_place.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'child_birth_place.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'child_gender.required' => 'Ce champ est obligatoire.',
                'child_gender.*.required' => 'Ce champ est obligatoire.',
                'child_gender.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'child_gender.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'child_status.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'child_status.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
