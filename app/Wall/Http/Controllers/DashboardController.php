<?php

namespace App\Wall\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        return view(settings('theme_folder') . 'dashboard/admin');
    }
}
