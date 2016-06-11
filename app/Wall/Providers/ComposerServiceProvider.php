<?php

namespace App\Wall\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(settings('theme_folder') . 'compose_views/compose-user-listing', 'App\Wall\Http\ViewComposer\UserListingComposer');
    }

    public function register()
    {
    }
}
