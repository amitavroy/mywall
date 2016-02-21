<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepository;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $role;

    /**
     * Role controller constructor
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    public function getRoleList()
    {
        return view(settings('theme_folder') . 'permissions/roles-list');
    }
}
