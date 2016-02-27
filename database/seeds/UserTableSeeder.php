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

        $manageRolePermission = new Permission();
        $manageRolePermission->name = 'manage-role-perm';
        $manageRolePermission->display_name = 'Manage Role & Permissions';
        $manageRolePermission->description = 'Manage roles and give permissios to role holders.';
        $manageRolePermission->save();

        $manageUserPermission = new Permission();
        $manageUserPermission->name = 'manage-users';
        $manageUserPermission->display_name = 'Manage Users';
        $manageUserPermission->description = 'Manage users. Add, Edit and Delete users from admin interface.';
        $manageUserPermission->save();

        $activityPermission = new Permission();
        $activityPermission->name = 'view-activity';
        $activityPermission->display_name = 'View User Activity';
        $activityPermission->description = 'Allow users to view other user\'s activity';
        $activityPermission->save();

        $superAdmin->attachPermission($manageRolePermission);
        $superAdmin->attachPermission($manageUserPermission);
        $superAdmin->attachPermission($activityPermission);

        $user = User::create([
            'name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => \Illuminate\Support\Facades\Hash::make('pass'),
            'first_name' => 'Amitav',
            'last_name' => 'Roy',
            'status' => 1,
        ]);

        $authUser = User::create([
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('pass'),
            'first_name' => 'Jhon',
            'last_name' => 'Doe',
            'status' => 1,
        ]);

        $authUser->attachRole($authUser);
        $user->attachRole($superAdmin);
    }
}
