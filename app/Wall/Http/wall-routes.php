<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/23/16
 * Time: 3:19 PM
 */

Route::group(['middleware' => 'web'], function () {
    /**
     * Social logins
     */
    Route::get('auth/facebook', [
        'as' => 'auth-facebook',
        'uses' => '\App\Wall\Http\Controllers\UserController@redirectToProvider',
    ]);

    Route::get('auth/facebook/callback', [
        'as' => 'facebook-callback',
        'uses' => '\App\Wall\Http\Controllers\UserController@handleProviderCallback',
    ]);
});

Route::group(['middleware' => ['web', 'auth']], function () {
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
     * Role and Permission urls
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
            'uses' => '\App\Wall\Http\Controllers\PermissionController@getPermissionList'
        ]);

        Route::post('save-permission', [
            'as' => 'permission.save',
            'uses' => '\App\Wall\Http\Controllers\PermissionController@postSaveNewPermission'
        ]);

        Route::get('permission-matrix', [
            'as' => 'permission.matrix',
            'uses' => '\App\Wall\Http\Controllers\PermissionController@getPermissionMatrix'
        ]);

        Route::post('permission-matrix-save', [
            'as' => 'permission.matrix.save',
            'uses' => '\App\Wall\Http\Controllers\PermissionController@postPermissionMatrix'
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

    /**
     * Settings URLs
     */
    Route::group(['prefix' => 'settings', 'middleware' => 'permission:manage-settings'], function () {

        Route::get('manage', [
            'as' => 'settings.manage',
            'uses' => '\App\Wall\Http\Controllers\SettingsController@getSettingsList'
        ]);

        Route::post('save', [
            'as' => 'settings.save',
            'uses' => '\App\Wall\Http\Controllers\SettingsController@postSettingsSave'
        ]);

    });
});
