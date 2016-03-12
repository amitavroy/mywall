<?php

namespace App\Http\Controllers;

use App\Events\User\Created;
use App\Events\User\PasswordChange;
use App\Events\User\ProfileUpdate;
use App\Http\Requests;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Mail\MailRepository;
use App\Role;
use App\Support\FileManager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    /**
     * Get the profile page to the user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfilePage()
    {
        $user = Auth::user();
        return view(settings('theme_folder') . 'user.user-profile', compact('user'));
    }

    /**
     * Save the profile details
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function postProfilePage(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        return response($user->toArray(), 200);
    }

    /**
     * Handle the save user profile image
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function postSaveUserAvatar(Request $request)
    {
        $user = new User;
        $user->handleUserProfilePicUpdate($request);

        $fm = new FileManager;

        $file = $fm->uploadImageFileFromBase64String($request->input('avatar'), 'fw-labs-db/uploads/profile_pic/', null, 's3');

        $user = Auth::user();
        $user->avatar_url = $file->file_path;
        $user->save();

        return response(['data' => [
            'image_url' => $fm->uriToUrl($file->file_path)
        ]], 200);
    }

    /**
     * Get the page to add a new user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddUser()
    {
        return view(settings('theme_folder') . 'user/user-add');
    }

    /**
     * Get the page to list the users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserList()
    {
        $users = User::all();
        return view(settings('theme_folder') . 'user/user-list', compact('users'));
    }

    /**
     * Create a new user and save it
     *
     * @param CreateUserRequest $request
     * @param MailRepository $mail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSaveUser(CreateUserRequest $request, MailRepository $mail)
    {
        $pass = null;
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->status = 1;

        if (settings('send_password_through_mail') == true) {
            $pass = uniqid();
            $user->password = Hash::make($pass);
        } else {
            $user->password = Hash::make($request->input('password'));
        }

        event(new Created($user, $pass, $mail));

        $user->save();

        return redirect()->back();
    }

    /**
     * Get the password change page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPasswordChangePage()
    {
        return view(settings('theme_folder') . 'user/user-settings');
    }

    /**
     * Make the password change
     *
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        $user->password = Hash::make($request->input('confirm_password'));
        $user->save();

        event(new PasswordChange());
        Flash::success('Password changed.');
        return redirect()->back();
    }

    /**
     * Get the user edit page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserEdit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('id')->get();
        return view(settings('theme_folder') . 'user/user-edit', compact('user', 'roles'));
    }

    /**
     * Updating the user profile. Submit for the profile edit page
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdateUser(UserUpdateRequest $request)
    {
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        foreach ($user->roles as $role) {
            if ($role->id != 1) {
                $user->detachRole($role);
            }
        }

        if ($request->input('role') && count($request->input('role')) > 0) {
            foreach ($request->input('role') as $key => $rid) {
                $role = Role::findOrFail($key);
                $user->attachRole($role);
            }
        }

        event(new ProfileUpdate());
        Flash::success('User profile updated.');
        return redirect()->back();
    }
}
