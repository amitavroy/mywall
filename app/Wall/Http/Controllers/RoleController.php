<?php

namespace App\Wall\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Wall\Http\Request\Role\CreateRoleRequest;
use App\Wall\Repositories\Role\RoleRepository;
use Laracasts\Flash\Flash;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $role;

    /**
     * Role controller constructor
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    /**
     * Get the list of Roles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRoleList()
    {
        $roles = $this->role->all();
        return view(settings('theme_folder') . 'permissions/roles-list', compact('roles'));
    }

    public function postSaveRole(CreateRoleRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ];

        $this->role->create($data);

        return redirect()->back();
    }

    public function getDeleteRole($id)
    {
        $this->role->delete($id);

        Flash::success('Role was deleted');

        return redirect()->back();
    }

}
