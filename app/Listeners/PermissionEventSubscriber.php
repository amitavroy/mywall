<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/27/16
 * Time: 9:39 PM
 */

namespace App\Listeners;


use App\Permission;
use App\Support\Activity\Logger;
use App\Events\Permission\Created;

class PermissionEventSubscriber
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * PermissionEventSubscriber constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onCreate(Created $event)
    {
        $this->logger->log('A new permissions was create');
        $event->addPermissionToSuperAdmin();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'App\Listeners\PermissionEventSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
    }
}
