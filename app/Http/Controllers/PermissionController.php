<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function getPermissionList()
    {
        return view(settings('theme_folder') . 'permissions/permission-list');
    }
}
