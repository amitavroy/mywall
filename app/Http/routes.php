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

        Route::get('activity-log', [
            'as' => 'activity-log',
            'uses' => 'ActivityController@getUserActivityList',
        ]);

        Route::get('change-password', [
            'as' => 'user.change-password',
            'uses' => 'UserController@getPasswordChangePage',
        ]);

        Route::post('change-password', [
            'as' => 'user.save-new-password',
            'uses' => 'UserController@postChangePassword',
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

            Route::get('delete-role/{id}', [
                'as' => 'role.delete',
                'uses' => 'RoleController@getDeleteRole'
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

            Route::get('edit/{id}', [
                'as' => 'user.edit',
                'uses' => 'UserController@getUserEdit',
            ]);

            Route::post('update', [
                'as' => 'user.update',
                'uses' => 'UserController@postUpdateUser',
            ]);

        });

        /**
         * Activity URLs
         */
        Route::group(['prefix' => 'activity', 'middleware' => 'permission:view-activity'], function () {

            Route::get('list', [
                'as' => 'activity.list',
                'uses' => 'ActivityController@getActivityList'
            ]);

        });
    });
});
