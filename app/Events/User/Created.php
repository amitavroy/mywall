<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/25/16
 * Time: 12:47 PM
 */

namespace App\Events\User;

use App\User;

class Created
{
    private $user;
    private $password;

    /**
     * Created constructor.
     * @param User $user
     */
    public function __construct(User $user, $pass = null)
    {
        $this->user = $user;
        $this->password = $pass;
    }

    public function sendUserCreationEmail()
    {
        \Log::info('Password ' . $this->password);
    }
}
