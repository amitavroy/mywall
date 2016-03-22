<?php

namespace App\Wall\Listeners;

use App\Wall\Events\Role\Created;
use App\Support\Activity\Logger;
use App\Wall\Events\Role\Deleted;

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

    public function onDelete()
    {
        $this->logger->log('A new role was deleted.');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'App\Wall\Listeners\RoleEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
