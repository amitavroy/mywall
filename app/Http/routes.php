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
            'uses' => 'Auth\AuthController@doLogout',
        ]);

        Route::get('/', [
            'as' => 'dashboard',
            'uses' => 'DashboardController@getDashboard',
        ]);

        /**
         * Profile urls
         */
        Route::get('profile', [
            'as' => 'profile',
            'uses' => 'UserController@getProfilePage',
        ]);

        Route::post('profile', [
            'as' => 'profile.save',
            'uses' => 'UserController@postProfilePage',
        ]);

        Route::post('avatar-save', [
            'as' => 'avatar.save',
            'uses' => 'UserController@postSaveUserAvatar',
        ]);

        /**
         * Permission urls
         */
        Route::group(['prefix' => 'permissions', 'middleware' => 'role:super admin'], function () {

            Route::get('manage-roles', [
                'as' => 'roles.view',
                'uses' => 'RoleController@getRoleList',
            ]);

            Route::post('save-role', [
                'as' => 'role.save',
                'uses' => 'RoleController@postSaveRole',
            ]);

            Route::get('manage-permission', [
                'as' => 'permission.list',
                'uses' => 'PermissionController@getPermissionList'
            ]);

            Route::post('save-permission', [
                'as' => 'permission.save',
                'uses' => 'PermissionController@postSaveNewPermission'
            ]);

        });

        /**
         * Users urls
         */
        Route::group(['prefix' => 'users', 'middleware' => 'permission:manage-users'], function () {

            Route::get('add', [
                'as' => 'user.add',
                'uses' => 'UserController@getAddUser',
            ]);

            Route::post('add', [
                'as' => 'user.save',
                'uses' => 'UserController@postSaveUser',
            ]);

            Route::get('list', [
                'as' => 'user.list',
                'uses' => 'UserController@getUserList',
            ]);

        });
    });
});
