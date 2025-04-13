<?php

namespace App\Support;

class SchoolFields
{
    public static function getFields(): array
    {
        return [
            'school_name' => 'required|array',
            'school_name.*' => 'required|string|max:255',
            'duration' => 'required|array',
            'duration.*' => 'required|string|max:255',
            'diploma' => 'nullable|array',
            'diploma.*' => 'nullable|string',
        ];
    }

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
                'school_name.required' => 'Ce champ est obligatoire.',
                'school_name.*.required' => 'Ce champ est obligatoire.',
                'school_name.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'school_name.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'duration.required' => 'Ce champ est obligatoire.',
                'duration.*.required' => 'Ce champ est obligatoire.',
                'duration.*.string' => 'Ce champ doit être une chaîne de caractères.',
                'duration.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
                'diploma.*.string' => 'Ce champ doit être une chaîne de caractères.',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
