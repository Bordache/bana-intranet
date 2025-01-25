<?php

namespace App\Support;

class CampaignFields
{
    public static function getFields(): array
    {
        return [
           'campaign_title' => 'required|array',
            'campaign_period' => 'nullable|array',
            'campaign_locations' => 'nullable|array',
            'campaign_title.*' => 'required|string|max:255',
            'campaign_period.*' => 'nullable|string|max:255',
            'campaign_locations.*' => 'nullable|string|max:255',
        ];
    }

    /**
     * Retourne les messages d'erreur personnalisés pour les règles.
     */
    public static function getMessages(): array
    {

        return [
            'campaign_title.required' => 'Ce champ est obligatoire.',
            'campaign_title.*.required' => 'Ce champ est obligatoire.',
            'campaign_title.*.string' => 'Ce champ doit être une chaîne de caractères.',
            'campaign_title.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
            'campaign_period.*.string' => 'Ce champ doit être une chaîne de caractères.',
            'campaign_period.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
            'campaign_locations.*.string' => 'Ce champ doit être une chaîne de caractères.',
            'campaign_locations.*.max' => 'Ce champ ne peut pas dépasser 255 caractères.',
        ];
    }


    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
