<?php

namespace App\Repositories\Role;

use App\Events\Role\Created;
use App\Repositories\Role\RoleRepository;
use App\Role;

class EloquentRole implements RoleRepository
{
    /**
     * Get all system roles
     *
     * @return Illuminate database collection
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * Find role by id
     *
     * @param  string $id
     * @return Illuminate database row
     */
    public function findById($id)
    {
        return Role::find($id);
    }

    /**
     * Find role by name
     *
     * @param  string $name
     * @return Illuminate database row
     */
    public function findByName($name)
    {
        return Role::where('name', $name)->first();
    }

    /**
     * Create new system role.
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data)
    {
        $role = Role::create($data);

        event(new Created($role));

        return $role;
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

    }

    /**
     * Remove role from repository.
     *
     * @param $id Role Id
     * @return bool
     */
    public function delete($id)
    {

    }
}
