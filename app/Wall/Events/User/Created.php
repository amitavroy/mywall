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
     * @param MailRepository $mail
     */
    public function __construct(User $user, $pass = null, MailRepository $mail)
    {
        $this->user = $user;
        $this->password = $pass;
        $this->mail = $mail;
    }

    public function sendUserCreationEmail()
    {
        $mailData = [
            'pass' => $this->password,
            'user' => $this->user,
        ];

        $this->mail->log([
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
