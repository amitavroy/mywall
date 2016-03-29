<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 11:23 PM
 */

namespace App\Wall\Repositories\Permission;


use App\Permission;
use App\Wall\Repositories\EloquentDBRepository;

class EloquentPermission extends EloquentDBRepository implements PermissionRepository
{
    /**
     * @var Permissions
     */
    protected $model;

    /**
     * EloquentPermission constructor.
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Create new system role.
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update specified role.
     *
     * @param $id Role Id
     * @param array $data
     * @return Role
     */
    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * Remove role from repository.
     *
     * @param $id Role Id
     * @return bool
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
