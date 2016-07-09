<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = new Role();
        $superAdmin->name = 'super admin';
        $superAdmin->display_name = 'Super admin';
        $superAdmin->description = 'This role holder has right to everything on the application.';
        $superAdmin->save();

        $authUser = new Role();
        $authUser->name = 'auth user';
        $authUser->display_name = 'Authenticated User';
        $authUser->description = 'This is the basic role which every registered user will get by default.';
        $authUser->save();

        /**
         * Manage Role Permissions
         */
        $manageRolePermission = new Permission();
        $manageRolePermission->name = 'manage-role-perm';
        $manageRolePermission->display_name = 'Manage Role & Permissions';
        $manageRolePermission->description = 'Manage roles and give permissions to role holders.';
        $manageRolePermission->save();
        $superAdmin->attachPermission($manageRolePermission);

        /**
         * Manage User Permission
         */
        $manageUserPermission = new Permission();
        $manageUserPermission->name = 'manage-users';
        $manageUserPermission->display_name = 'Manage Users';
        $manageUserPermission->description = 'Manage Users';
        $manageUserPermission->save();
        $superAdmin->attachPermission($manageUserPermission);

        /**
         * Manage Permission to see Activity
         */
        $manageActivityViewPermission = new Permission();
        $manageActivityViewPermission->name = 'view-activity';
        $manageActivityViewPermission->display_name = 'View Activity';
        $manageActivityViewPermission->description = 'View the different user activity in the system.';
        $manageActivityViewPermission->save();
        $superAdmin->attachPermission($manageActivityViewPermission);

        /**
         * Manage settings for application
         */
        $manageSettingsPermission = new Permission();
        $manageSettingsPermission->name = 'manage-settings';
        $manageSettingsPermission->display_name = 'Manage Settings';
        $manageSettingsPermission->description = 'Manage Settings for the application. User can change settings.';
        $manageSettingsPermission->save();
        $superAdmin->attachPermission($manageSettingsPermission);

        $user = User::create([
            'name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'first_name' => 'Amitav',
            'last_name' => 'Roy',
            'status' => 1,
        ]);

        $authUser = User::create([
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'first_name' => 'Jhon',
            'last_name' => 'Doe',
            'status' => 1,
        ]);

        $authUser->attachRole($authUser);
        $user->attachRole($superAdmin);
    }
}
