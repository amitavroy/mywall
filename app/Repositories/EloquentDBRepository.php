<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 11:17 PM
 */

namespace App\Repositories;


abstract class EloquentDBRepository
{
    /**
     * Get all system roles
     *
     * @return Illuminate database collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find role by id
     *
     * @param  string $id
     * @return Illuminate database row
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find role by name
     *
     * @param  string $name
     * @return Illuminate database row
     */
    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}
