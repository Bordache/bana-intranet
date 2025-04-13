<?php

namespace App\Support;

class ProfileFields
{
    /**
     * Retourne les règles de validation des champs.
     */
    public static function getFields(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255',
            ],
            'firstname' => [
                'nullable',
                'string',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/',
                'max:255',
            ],
            'gender' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'national_id' => 'required|numeric|digits:12|unique:profiles,national_id',
            'issue_date' => 'nullable|date',
            'issue_place' => 'nullable|string|max:255',
            'duplicate_date' => 'nullable|date',
            'duplicate_place' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:255',
            'size' => 'nullable|integer|min:150',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'fallback_address' => 'nullable|string|max:255',
            'driver_license' => 'nullable|string|max:255',
            'practiced_sport' => 'nullable|string',
            'hobbies' => 'nullable|string',
        ];
    }

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {
        return [
            'name.required' => 'Ce champ est obligatoire.',
            'name.string' => 'Ce champ doit être une chaîne de caractères.',
            'name.regex' => 'Ce champ contient des caractères non valides.',
            'name.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'firstname.string' => 'Ce champ doit être une chaîne de caractères.',
            'firstname.regex' => 'Ce champ contient des caractères non valides.',
            'firstname.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'gender.string' => 'Ce champ doit être une chaîne de caractères.',
            'gender.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'birth_date.date' => 'Ce champ doit être une date valide.',

            'birth_place.string' => 'Ce champ doit être une chaîne de caractères.',
            'birth_place.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'national_id.required' => 'Ce champ est obligatoire.',
            'national_id.numeric' => 'Ce champ doit être un nombre.',
            'national_id.digits' => 'Ce champ doit contenir exactement 12 chiffres.',
            'national_id.unique' => 'Cette valeur existe déjà.',

            'issue_date.date' => 'Ce champ doit être une date valide.',

            'issue_place.string' => 'Ce champ doit être une chaîne de caractères.',
            'issue_place.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'duplicate_date.date' => 'Ce champ doit être une date valide.',

            'duplicate_place.string' => 'Ce champ doit être une chaîne de caractères.',
            'duplicate_place.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'address.string' => 'Ce champ doit être une chaîne de caractères.',
            'address.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'phone.string' => 'Ce champ doit être une chaîne de caractères.',
            'phone.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'email.email' => 'Ce champ doit être une adresse email valide.',
            'email.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'blood_group.string' => 'Ce champ doit être une chaîne de caractères.',
            'blood_group.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'size.integer' => 'Ce champ doit être un entier.',
            'size.min' => 'Ce champ doit être au moins 150 cm.',

            'father_name.string' => 'Ce champ doit être une chaîne de caractères.',
            'father_name.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'mother_name.string' => 'Ce champ doit être une chaîne de caractères.',
            'mother_name.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'marital_status.string' => 'Ce champ doit être une chaîne de caractères.',
            'marital_status.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'fallback_address.string' => 'Ce champ doit être une chaîne de caractères.',
            'fallback_address.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'driver_license.string' => 'Ce champ doit être une chaîne de caractères.',
            'driver_license.max' => 'Ce champ ne peut pas dépasser 255 caractères.',

            'practiced_sport.string' => 'Ce champ doit être une chaîne de caractères.',

            'hobbies.string' => 'Ce champ doit être une chaîne de caractères.',
        ];
    }

    /**
     * Retourne les noms des champs.
     */
    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}

