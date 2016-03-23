<?php

namespace App\Wall\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Get the dashboard page for the user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
        return view(settings('theme_folder') . 'dashboard/admin');
    }
}
