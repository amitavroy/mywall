<?php

namespace App\Providers;

use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\EloquentActivity;
use App\Repositories\Mail\EloquentMail;
use App\Repositories\Mail\MailRepository;
use App\Repositories\Permission\EloquentPermission;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\EloquentRole;
use App\Repositories\Role\RoleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
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
