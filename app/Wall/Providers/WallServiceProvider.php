<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/29/16
 * Time: 8:07 PM
 */

namespace App\Wall\Providers;


use App\Listeners\PermissionEventSubscriber;
use App\Repositories\Mail\EloquentMail;
use App\Repositories\Mail\MailRepository;
use App\Wall\Listeners\RoleEventsSubscriber;
use App\Wall\Listeners\UserEventSubscriber;
use App\Wall\Repositories\Activity\ActivityRepository;
use App\Wall\Repositories\Activity\EloquentActivity;
use App\Wall\Repositories\Permission\EloquentPermission;
use App\Wall\Repositories\Permission\PermissionRepository;
use App\Wall\Repositories\Role\EloquentRole;
use App\Wall\Repositories\Role\RoleRepository;
use App\Wall\Repositories\User\EloquentUser;
use App\Wall\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class WallServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(MailRepository::class, EloquentMail::class);
    }
}
