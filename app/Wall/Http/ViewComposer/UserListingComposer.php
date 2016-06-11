<?php

namespace App\Wall\Http\ViewComposer;

use App\Wall\Repositories\User\UserRepository;
use Illuminate\Contracts\View\View;

class UserListingComposer
{
    private $user;

    public function __construct(UserRepository $user)
    {
    	// dd(1);
        $this->user = $user;
    }

    public function compose(View $view)
    {
    	$users = $this->user->userList();
        $view->with('users', $users);
    }
}
