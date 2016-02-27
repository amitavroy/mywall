<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/27/16
 * Time: 9:32 PM
 */

namespace App\Events\Permission;


use App\Permission;
use App\Role;

class Created
{
    /**
     * @var Permission
     */
    private $permission;

    /**
     * Created constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function addPermissionToSuperAdmin()
    {
        $superAdmin = Role::find(1);

        $superAdmin->attachPermission($this->permission);
    }
}
