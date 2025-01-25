<?php

namespace App\Support;

class SpouseFields
{
    public static function getFields(): array
    {
        return [
            'spouse_title' => 'required|array',
            'spouse_name' => 'required|array',
            'spouse_maiden_name' => 'nullable|array',
            'spouse_firstname' => 'nullable|array',
            'spouse_birth_date' => 'nullable|array',
            'spouse_birth_place' => 'nullable|array',
            'spouse_profession' => 'nullable|array',
            'marriage_authorization' => 'nullable|array',
            'spouse_title.*' => 'required|string|max:255',
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

     /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
                'spouse_title.required' => 'Ce champ est obligatoire.',
                'spouse_title.*.required' => 'Ce champ est obligatoire.',
                'spouse_title.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'spouse_title.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'spouse_name.required' => 'Ce champ est obligatoire.',
                'spouse_name.*.required' => 'Ce champ est obligatoire.',
                'spouse_name.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'spouse_name.*.regex' => 'Ce champ contient des caractères non valides.',
                'spouse_name.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'spouse_maiden_name.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'spouse_maiden_name.*.regex' => 'Ce champ contient des caractères non valides.',
                'spouse_maiden_name.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'spouse_firstname.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'spouse_firstname.*.regex' => 'Ce champ contient des caractères non valides.',
                'spouse_firstname.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'spouse_birth_date.*.date' => 'Ce champ doit être une date valide.',
                'spouse_birth_place.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'spouse_birth_place.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'spouse_profession.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'spouse_profession.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'marriage_authorization.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'marriage_authorization.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
