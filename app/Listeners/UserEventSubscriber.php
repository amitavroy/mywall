<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/25/16
 * Time: 12:48 PM
 */

namespace App\Listeners;


use App\Events\User\Created;
use App\Events\User\LoggedIn;
use App\Events\User\Logout;
use App\Support\Activity\Logger;
use Illuminate\Support\Facades\Auth;

class UserEventSubscriber
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Raising the event when a new user is created.
     * 
     * @param Created $event
     */
    public function onCreate(Created $event)
    {
        $this->logger->log('A new user was create');

        if (settings('send_password_through_mail') == true) {
            $event->sendUserCreationEmail();
            $this->logger->log('User registration mail was sent.');
        }
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
        $class = 'App\Listeners\UserEventSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(LoggedIn::class, "{$class}@loggedIn");
        $events->listen(Logout::class, "{$class}@logout");
    }
}
