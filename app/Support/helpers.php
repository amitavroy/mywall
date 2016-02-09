<?php

if (!function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        $settings = json_decode(file_get_contents(storage_path('settings.json')));

        if (is_null($key)) {
            return $settings;
        }

        if (isset($settings->$key)) {
            return $settings->$key;
        }

        return null;
    }
}

if (!function_exists('theme_url')) {
    function theme_url($path = null)
    {
        if (null == $path) {
            return url(settings('theme_folder'));
        }

        return url(settings('theme_folder') . $path);
    }
}
