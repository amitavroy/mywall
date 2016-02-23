<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatePermissionRequest;
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

        $this->permission->create($data);

        return redirect()->back();
    }
}
