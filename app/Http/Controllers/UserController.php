<?php

namespace App\Http\Controllers;

use App\Events\User\Created;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Repositories\Mail\MailRepository;
use App\Support\FileManager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return view('pages.user.user-profile', compact('user'));
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

    public function getAddUser()
    {
        return view(settings('theme_folder') . 'user/user-add');
    }

    public function getUserList()
    {
        $users = User::all();
        return view(settings('theme_folder') . 'user/user-list', compact('users'));
    }

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
}
