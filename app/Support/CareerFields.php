<?php

namespace App\Support;

class CareerFields
{
    public static function getFields(): array
    {
        return [
           'company_name' => 'required|array',
            'job_title' => 'nullable|array',
            'start_date' => 'required|array',
            'end_date' => 'nullable|array',
            'description' => 'nullable|array',
            'company_name.*' => 'required|string|max:255',
            'job_title.*' => 'nullable|string|max:255',
            'start_date.*' => 'required|date',
            'end_date.*' => 'nullable|date',
            'description.*' => 'nullable|string',
        ];
    }

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
            'company_name.required' => 'Ce champ est obligatoire.',
            'company_name.*.required' => 'Ce champ est obligatoire.',
            'company_name.*.string' => 'Ce champ doit être une chaîne de caractères.',
            'company_name.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
            'job_title.*.string' => 'Ce champ doit être une chaîne de caractères.',
            'job_title.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
            'start_date.required' => 'Ce champ est obligatoire.',
            'start_date.*.required' => 'Ce champ est obligatoire.',
            'start_date.*.date' => 'Ce champ doit être une date valide.',
            'end_date.*.date' => 'Ce champ doit être une date valide.',
            'description.*.string' => 'Ce champ doit être une chaîne de caractères.',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
