<?php

namespace App\Listeners;

use App\Events\Role\Created;
use App\Support\Activity\Logger;

class RoleEventsSubscriber
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

    public function onCreate()
    {
        $this->logger->log('A new role was create');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'App\Listeners\RoleEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
    }
}
