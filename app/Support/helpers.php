<?php

if (!function_exists('settings')) {
    /**
     * Get the setting saved in settings.json file
     * based on the library anlutro/l4-settings
     *
     * @param null $key
     * @return mixed
     */
    function settings($key = null)
    {
        return \Setting::get($key);
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
