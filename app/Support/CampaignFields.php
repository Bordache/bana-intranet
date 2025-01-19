<?php

namespace App\Support;

class CampaignFields
{
    public static function getFields(): array
    {
        return [
           'campaign_title' => 'required|array',
            'campaign_period' => 'required|array',
            'campaign_locations' => 'required|array',
            'campaign_title.*' => 'required|string|max:255',
            'campaign_period.*' => 'required|string|max:255',
            'campaign_locations.*' => 'required|string|max:255',
        ];
    }

    public static function getFieldNames(): array
    {
        return array_keys(self::getFields());
    }
}
