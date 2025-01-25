<?php

namespace App\Support;

class AcademyFields
{
    public static function getFields(): array
    {
        return [
            'academy_name' => 'required|array',
            'academy_name.*' => 'required|string|max:255',
            'academy_duration' => 'required|array',
            'academy_duration.*' => 'required|string|max:255',
            'academy_diploma' => 'nullable|array',
            'academy_diploma.*' => 'nullable|string',
        ];
    }

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
            'academy_name.required' => 'Ce champ est obligatoire.',
            'academy_name.*.required' => 'Ce champ est obligatoire.',
            'academy_name.*.string' => 'Ce champ doit être une chaîne de caractères.',
            'academy_name.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
            'academy_duration.required' => 'Ce champ est obligatoire.',
            'academy_duration.*.required' => 'Ce champ est obligatoire.',
            'academy_duration.*.string' => 'Ce champ doit être une chaîne de caractères.',
            'academy_duration.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
            'academy_diploma.*.string' => 'Ce champ doit être une chaîne de caractères.',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
