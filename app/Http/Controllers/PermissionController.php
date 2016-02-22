<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\Permission\PermissionRepository;

class PermissionController extends Controller
{
    /**
     * @var PermissionRepository
     */
    private $permission;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permission
     */
    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }

    public function getPermissionList()
    {
        $permissions = $this->permission->all();
        return view(settings('theme_folder') . 'permissions/permission-list', compact('permissions'));
    }
}
