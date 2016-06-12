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
use App\Wall\Repositories\Role\RoleRepository;

class EloquentUser implements UserRepository
{
    /**
     * @var User
     */
    private $model;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * EloquentUser constructor.
     * @param User $model
     * @param RoleRepository $roleRepository
     */
    public function __construct(User $model, RoleRepository $roleRepository)
    {
        $this->model = $model;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Find a user by it's id.
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new user and attache the default Auth user role.
     *
     * @param array $data
     * @param $pass
     * @return static
     */
    public function create(array $data, $pass)
    {
        $userData = $this->model->create($data);

        $authUserRole = $this->roleRepository->findById(2);

        $userData->attachRole($authUserRole);

        event(new Created($userData, $pass));

        return $userData;
    }

    /**
     * Attach Roles to a User.
     *
     * @param $user
     * @param $roleIds
     */
    public function addRoles($user, $roleIds)
    {
        foreach ($roleIds as $id => $value) {
            $role = $this->roleRepository->findById($id);
            $user->attachRole($role);
        }
    }

    /**
     * Get the list of users with pagination.
     * 
     * @return [type]
     */
    public function userList()
    {
        return $this->model->with('roles')->paginate(20);
    }

    /**
     * Check if a user is present for the Social Network 
     * by checking with the SNS type and SNS account id.
     * 
     * @param  $type Social network type
     * @param  $id Social network account id
     * @return User object
     */
    public function findOrCreateSocialUser($type, $id, $userObj)
    {
        $user = $this->model
            ->where('account_type', $type)
            ->where('sns_acc_id', $id)
            ->first();

        if ($user) {
            return $user;
        }

        if ($type == 'facebook') {
            $user = $this->createFacebookUser($userObj);
        }

        return $user;
    }

    private function createFacebookUser($userObj)
    {
        $userData = [
            'name' => isset($userObj->name) ? $userObj->name : '',
            'email' => isset($userObj->email) ? $userObj->email : '',
            'avatar_url' => isset($userObj->avatar_original) ? $userObj->avatar_original : '',
            'sns_acc_id' => $userObj->id,
            'account_type' => 'facebook',
        ];

        return $this->create($userData, '');
    }
}
