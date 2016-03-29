<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/25/16
 * Time: 12:47 PM
 */

namespace App\Wall\Events\User;

use App\Repositories\Mail\MailRepository;
use App\User;
use Illuminate\Support\Facades\View;

class Created
{
    private $user;
    private $password;
    /**
     * @var MailRepository
     */
    private $mail;

    /**
     * Created constructor.
     * @param User $user
     * @param null $pass
     */
    public function __construct($user, $pass = null)
    {
        $this->user = $user;
        $this->password = $pass;
    }

    public function sendUserCreationEmail(MailRepository $mail)
    {
        $mailData = [
            'pass' => $this->password,
            'user' => $this->user,
        ];

        $mail->log([
            'from' => 'amitav.roy@focalworks.in',
            'to' => $this->user->email,
            'message' => View::make(settings('theme_folder') . 'mails/user-created-mail')
                ->with(['user' => $this->user, 'pass' => $this->password]),
            'attachment' => '',
            'status' => 1,
            'type' => 'Registration mail',
            'subject' => 'Welcome to ' . settings('site_name'),
            'view' => settings('theme_folder') . 'mails/user-created-mail',
            'mailData' => $mailData,
        ]);
    }
}
