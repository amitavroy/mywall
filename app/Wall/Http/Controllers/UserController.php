<?php

namespace App\Wall\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\Mail\MailRepository;
use App\Role;
use App\Support\FileManager;
use App\User;
use App\Wall\Events\User\LoggedIn;
use App\Wall\Events\User\PasswordChange;
use App\Wall\Events\User\ProfileUpdate;
use App\Wall\Http\Request\User\ChangePasswordRequest;
use App\Wall\Http\Request\User\CreateUserRequest;
use App\Wall\Http\Request\User\UserUpdateRequest;
use App\Wall\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Socialite;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $user;

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Redirect the user to the Facebook auth page and get the token.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle the user's token call back,
     * check if new user needs to be created
     * then login the user.
     *
     * @return [type]
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $checkUser = $this->user->findOrCreateSocialUser('facebook', $user->id, $user);

        Auth::login($checkUser, true);

        event(new LoggedIn(Auth::user()));

        return redirect()->route('dashboard');
    }

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
     *
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
        $roles = Role::orderBy('id')->get();
        return view(settings('theme_folder') . 'user/user-add', compact('roles'));
    }

    /**
     * Get the page to list the users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserList()
    {
        return view(settings('theme_folder') . 'user/user-list');
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
        // generate the user data
        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'status' => 1,
        ];

        // check if email needs to be sent
        if (settings('send_password_through_mail') == true) {
            $pass = uniqid();
            $userData['password'] = Hash::make($pass);
        } else {
            $userData['password'] = Hash::make($request->input('password'));
            $pass = Hash::make($request->input('password'));
        }

        $userCreated = $this->user->create($userData, $pass);

        // if role was selected
        if ($request->input('role')) {
            $this->user->addRoles($userCreated, $request->input('role'));
        }

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
