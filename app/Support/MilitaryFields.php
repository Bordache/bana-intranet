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
            'military_id_card_number' => 'nullable|string|max:255',
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

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
                'army.required' => 'Ce champ est obligatoire.',
                'army.string' => 'Ce champ doit être une chaîne de caractères.',
                'army.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'position.required' => 'Ce champ est obligatoire.',
                'position.string' => 'Ce champ doit être une chaîne de caractères.',
                'position.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'position_date.date' => 'Ce champ doit être une date valide.',

                'position_reference.string' => 'Ce champ doit être une chaîne de caractères.',
                'position_reference.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'military_registration_number.required' => 'Ce champ est obligatoire.',
                'military_registration_number.string' => 'Ce champ doit être une chaîne de caractères.',
                'military_registration_number.max' => 'Ce champ ne peut pas dépasser 6 caractères.',

                'military_id_card_number.string' => 'Ce champ doit être une chaîne de caractères.',
                'military_id_card_number.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'finance_registration_number.string' => 'Ce champ doit être une chaîne de caractères.',
                'finance_registration_number.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'recruitment_origin.string' => 'Ce champ doit être une chaîne de caractères.',
                'recruitment_origin.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'recruitment_promotion.string' => 'Ce champ doit être une chaîne de caractères.',
                'recruitment_promotion.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'service_entry_date.required' => 'Ce champ est obligatoire.',
                'service_entry_date.date' => 'Ce champ doit être une date valide.',

                'corps_assignment.required' => 'Ce champ est obligatoire.',
                'corps_assignment.string' => 'Ce champ doit être une chaîne de caractères.',
                'corps_assignment.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'unit_id.required' => 'Ce champ est obligatoire.',
                'unit_id.integer' => 'Ce champ doit être un entier.',
                'unit_id.exists' => 'Ce champ doit correspondre à un identifiant d’unité valide.',

                'rank_id.required' => 'Ce champ est obligatoire.',
                'rank_id.integer' => 'Ce champ doit être un entier.',
                'rank_id.exists' => 'Ce champ doit correspondre à un identifiant de grade valide.',

                'rank_date.date' => 'Ce champ doit être une date valide.',

                'current_function.string' => 'Ce champ doit être une chaîne de caractères.',
                'current_function.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'specialty.string' => 'Ce champ doit être une chaîne de caractères.',
                'specialty.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'exact_assignment.string' => 'Ce champ doit être une chaîne de caractères.',
                'exact_assignment.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'interruption_start_date.date' => 'Ce champ doit être une date valide.',

                'interruption_end_date.date' => 'Ce champ doit être une date valide.',

                'military_status.string' => 'Ce champ doit être une chaîne de caractères.',
                'military_status.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'military_status_reference.string' => 'Ce champ doit être une chaîne de caractères.',
                'military_status_reference.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'military_driver_license.string' => 'Ce champ doit être une chaîne de caractères.',
                'military_driver_license.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

                'other_information.string' => 'Ce champ doit être une chaîne de caractères.',
        ];

    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
