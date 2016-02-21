<?php

namespace App\Listeners;

use App\Events\Role\Created;

class RoleEventsSubscriber
{
    public function __construct()
    {

    }

    public function onCreate()
    {

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
