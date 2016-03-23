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
            'uses' => '\App\Wall\Http\Controllers\DashboardController@getDashboard',
        ]);

        /**
         * Profile urls
         */
        Route::get('profile', [
            'as' => 'profile',
            'uses' => '\App\Wall\Http\Controllers\UserController@getProfilePage',
        ]);

        Route::post('profile', [
            'as' => 'profile.save',
            'uses' => '\App\Wall\Http\Controllers\UserController@postProfilePage',
        ]);

        Route::post('avatar-save', [
            'as' => 'avatar.save',
            'uses' => '\App\Wall\Http\Controllers\UserController@postSaveUserAvatar',
        ]);

        Route::get('activity-log', [
            'as' => 'activity-log',
            'uses' => '\App\Wall\Http\Controllers\ActivityController@getUserActivityList',
        ]);

        Route::get('change-password', [
            'as' => 'user.change-password',
            'uses' => '\App\Wall\Http\Controllers\UserController@getPasswordChangePage',
        ]);

        Route::post('change-password', [
            'as' => 'user.save-new-password',
            'uses' => '\App\Wall\Http\Controllers\UserController@postChangePassword',
        ]);

        /**
         * Permission urls
         */
        Route::group(['prefix' => 'permissions', 'middleware' => 'role:super admin'], function () {

            Route::get('manage-roles', [
                'as' => 'roles.view',
                'uses' => '\App\Wall\Http\Controllers\RoleController@getRoleList',
            ]);

            Route::post('save-role', [
                'as' => 'role.save',
                'uses' => '\App\Wall\Http\Controllers\RoleController@postSaveRole',
            ]);

            Route::get('delete-role/{id}', [
                'as' => 'role.delete',
                'uses' => '\App\Wall\Http\Controllers\RoleController@getDeleteRole'
            ]);


            Route::get('manage-permission', [
                'as' => 'permission.list',
                'uses' => 'PermissionController@getPermissionList'
            ]);

            Route::post('save-permission', [
                'as' => 'permission.save',
                'uses' => 'PermissionController@postSaveNewPermission'
            ]);

            Route::get('permission-matrix', [
                'as' => 'permission.matrix',
                'uses' => 'PermissionController@getPermissionMatrix'
            ]);

            Route::post('permission-matrix-save', [
                'as' => 'permission.matrix.save',
                'uses' => 'PermissionController@postPermissionMatrix'
            ]);

        });

        /**
         * Users urls
         */
        Route::group(['prefix' => 'users', 'middleware' => 'permission:manage-users'], function () {

            Route::get('add', [
                'as' => 'user.add',
                'uses' => '\App\Wall\Http\Controllers\UserController@getAddUser',
            ]);

            Route::post('add', [
                'as' => 'user.save',
                'uses' => '\App\Wall\Http\Controllers\UserController@postSaveUser',
            ]);

            Route::get('list', [
                'as' => 'user.list',
                'uses' => '\App\Wall\Http\Controllers\UserController@getUserList',
            ]);

            Route::get('edit/{id}', [
                'as' => 'user.edit',
                'uses' => '\App\Wall\Http\Controllers\UserController@getUserEdit',
            ]);

            Route::post('update', [
                'as' => 'user.update',
                'uses' => '\App\Wall\Http\Controllers\UserController@postUpdateUser',
            ]);

        });

        /**
         * Activity URLs
         */
        Route::group(['prefix' => 'activity', 'middleware' => 'permission:view-activity'], function () {

            Route::get('list', [
                'as' => 'activity.list',
                'uses' => '\App\Wall\Http\Controllers\ActivityController@getActivityList'
            ]);

        });

    });
});
