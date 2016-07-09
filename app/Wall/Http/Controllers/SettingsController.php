<?php

namespace App\Wall\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laracasts\Flash\Flash;
use Setting;

class SettingsController extends Controller
{
    public function getSettingsList()
    {
        $settings = json_decode(file_get_contents(storage_path('settings.json')));

        return view(settings('theme_folder') . 'pages/settings-page', compact('settings'));
    }

    public function postSettingsSave(Request $request)
    {
        $postData = $request->all();

        foreach ($postData as $name => $value) {
            Setting::set($name, $value);
        }

        Setting::save();

        Flash::success('Settings are saved');

        return redirect()->back();
    }
}
