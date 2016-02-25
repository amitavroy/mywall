<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/25/16
 * Time: 12:48 PM
 */

namespace App\Listeners;


use App\Events\User\Created;
use App\Support\Activity\Logger;

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

    public function onCreate(Created $event)
    {
        $this->logger->log('A new user was create');
        $event->sendUserCreationEmail();
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
    }
}
