<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/25/16
 * Time: 12:47 PM
 */

namespace App\Events\User;

use App\User;
use Illuminate\Support\Facades\Mail;

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
        Mail::send(settings('theme_folder') . 'mails/user-created-mail', [
            'pass' => $this->password,
            'user' => $this->user,
        ], function ($m) {
            $m->from('amitav.roy@focalworks.in', 'Amitav Roy');
            $m->to($this->user->email, $this->user->name)->subject('Welcome to ' . settings('site_name'));
        });
    }
}
