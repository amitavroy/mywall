<?php

namespace App\Providers;

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
    }
}
