<?php

namespace App\Repositories\Role;

interface RoleRepository
{
    /**
     * Get all system roles
     * @return Illuminate database collection
     */
    public function all();

    /**
     * Find role by id
     * @param  string $id
     * @return Illuminate database row
     */
    public function findById($id);

    /**
     * Find role by name
     * @param  string $name
     * @return Illuminate database row
     */
    public function findByName($name);

    /**
     * Create new system role.
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data);

    /**
     * Update specified role.
     *
     * @param $id Role Id
     * @param array $data
     * @return Role
     */
    public function update($id, array $data);

    /**
     * Remove role from repository.
     *
     * @param $id Role Id
     * @return bool
     */
    public function delete($id);
}
