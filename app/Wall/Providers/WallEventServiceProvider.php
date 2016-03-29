<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/29/16
 * Time: 8:49 PM
 */

namespace App\Wall\Providers;

use App\Listeners\PermissionEventSubscriber;
use App\Wall\Listeners\RoleEventsSubscriber;
use App\Wall\Listeners\UserEventSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class WallEventServiceProvider extends ServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        RoleEventsSubscriber::class,
        UserEventSubscriber::class,
        PermissionEventSubscriber::class,
    ];
}
