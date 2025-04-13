<?php

if (!function_exists('highlight')) {
    function highlight($text, $search)
    {
        if (!$search || empty($text)) {
            return $text;
        }

        return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<mark>$1</mark>', $text);
    }
}
