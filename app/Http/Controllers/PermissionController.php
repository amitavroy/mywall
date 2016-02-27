<?php

namespace App\Http\Controllers;

use App\Events\Permission\Created;
use App\Http\Requests;
use App\Http\Requests\CreatePermissionRequest;
use App\Permission;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @var PermissionRepository
     */
    private $permission;
    /**
     * @var RoleRepository
     */
    private $role;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permission
     * @param RoleRepository $role
     */
    public function __construct(PermissionRepository $permission, RoleRepository $role)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    /**
     * Get the list of permissions from the system and
     * provide the form to add a new permission
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPermissionList()
    {
        $permissions = $this->permission->all();
        return view(settings('theme_folder') . 'permissions/permission-list', compact('permissions'));
    }

    public function postSaveNewPermission(CreatePermissionRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ];

        $perm = $this->permission->create($data);

        event(new Created($perm));

        return redirect()->back();
    }

    public function getPermissionMatrix()
    {
        $roles = $this->role->all();
        $permissions = $this->permission->all();

        return view(settings('theme_folder') . 'permissions/permission-matrix', compact('permissions', 'roles'));
    }

    public function postPermissionMatrix(Request $request)
    {
        $roles = $request->get('roles');

        if ($roles) {
            foreach ($roles as $roleId => $permissions) {
                $this->role->updatePermissions($roleId, $permissions);
            }
        }

        return redirect()->back()->withSuccess("Permissions updated");
    }
}
