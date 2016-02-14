<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => ['web']], function () {
    /**
     * Authentication
     */
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');

    /**
     * Auth based urls
     */
    Route::group(['middleware' => ['auth']], function () {

        Route::get('logout', [
            'as' => 'logout',
            'uses' => 'Auth\AuthController@doLogout'
        ]);

        Route::get('/', [
            'as' => 'dashboard',
            'uses' => 'DashboardController@getDashboard',
        ]);

        Route::get('profile', [
            'as' => 'profile',
            'uses' => 'UserController@getProfilePage'
        ]);

        Route::post('profile', [
            'as' => 'profile.save',
            'uses' => 'UserController@postProfilePage'
        ]);

    });
});
