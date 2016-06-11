<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/29/16
 * Time: 6:20 PM
 */

namespace App\Wall\Repositories\User;


interface UserRepository
{
    public function getById($id);

    public function create(array $data, $pass);

    public function addRoles($user, $roleIds);

    public function userList();
}
