<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/23/16
 * Time: 3:15 PM
 */

namespace App\Providers;


use App\Repositories\Mail\EloquentMail;
use App\Repositories\Mail\MailRepository;
use App\Wall\Repositories\Activity\ActivityRepository;
use App\Wall\Repositories\Activity\EloquentActivity;
use App\Wall\Repositories\Permission\EloquentPermission;
use App\Wall\Repositories\Permission\PermissionRepository;
use App\Wall\Repositories\Role\EloquentRole;
use App\Wall\Repositories\Role\RoleRepository;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class WallProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(MailRepository::class, EloquentMail::class);
    }
}
