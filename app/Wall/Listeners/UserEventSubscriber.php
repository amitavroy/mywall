<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/25/16
 * Time: 12:48 PM
 */

namespace App\Wall\Listeners;


use App\Repositories\Mail\MailRepository;
use App\Support\Activity\Logger;
use App\Wall\Events\User\Created;
use App\Wall\Events\User\LoggedIn;
use App\Wall\Events\User\Logout;
use App\Wall\Events\User\PasswordChange;
use App\Wall\Events\User\ProfileUpdate;
use Illuminate\Support\Facades\Auth;

class UserEventSubscriber
{
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var MailRepository
     */
    private $mail;

    /**
     * @param Logger $logger
     * @param MailRepository $mail
     */
    public function __construct(Logger $logger, MailRepository $mail)
    {
        $this->logger = $logger;
        $this->mail = $mail;
    }

    /**
     * Raising the event when a new user is created.
     *
     * @param Created $event
     */
    public function onCreate(Created $event)
    {
        $this->logger->log('A new user was create');

        if (settings('send_password_through_mail') == "true") {
            $event->sendUserCreationEmail($this->mail);
            $this->logger->log('User registration mail was sent.');
        }
    }

    /**
     * Event handle when user is updating the profile
     *
     * @param ProfileUpdate $event
     */
    public function onProfileUpdate(ProfileUpdate $event)
    {
        $this->logger->log('User updated his profile');
    }

    /**
     * Event handle when user has changed the password
     *
     * @param PasswordChange $event
     */
    public function onPasswordChange(PasswordChange $event)
    {
        $this->logger->log('User password was changed');
    }

    /**
     * Raising the event when user is logging in.
     *
     * @param LoggedIn $event
     */
    public function loggedIn(LoggedIn $event)
    {
        $this->logger->log(sprintf('A user %s logged in.', Auth::user()->name));
    }

    /**
     * Raising the event when a user is logging out.
     *
     * @param Logout $event
     */
    public function logout(Logout $event)
    {
        $this->logger->log(sprintf('A user %s logged out.', Auth::user()->name));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $class = 'App\Wall\Listeners\UserEventSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(LoggedIn::class, "{$class}@loggedIn");
        $events->listen(Logout::class, "{$class}@logout");
        $events->listen(ProfileUpdate::class, "{$class}@onProfileUpdate");
        $events->listen(PasswordChange::class, "{$class}@onPasswordChange");
    }
}
