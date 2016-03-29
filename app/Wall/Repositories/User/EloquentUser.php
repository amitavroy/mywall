<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/29/16
 * Time: 6:21 PM
 */

namespace App\Wall\Repositories\User;


use App\User;
use App\Wall\Events\User\Created;

class EloquentUser implements UserRepository
{
    /**
     * @var User
     */
    private $model;

    /**
     * EloquentUser constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data, $pass)
    {
        $userData = $this->model->create($data);
        event(new Created($userData, $pass));
    }
}
