<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function getProfilePage()
    {
        $user = Auth::user();
        return view('pages.user.user-profile', compact('user'));
    }

    public function postProfilePage(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        return response($user->toArray(), 200);
    }

    public function postSaveUserAvatar(Request $request)
    {
        $path = 'uploads/profile_pic/';
        $file_name = uniqid();
        $ext = '.jpg';

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        switch (exif_imagetype($request->input('avatar'))) {
            case 1:
                $ext = '.gif';
                break;

            case 3:
                $ext = '.png';
                break;
        }

        Image::make(file_get_contents($request->input('avatar')))
            ->resize(200, 200)
            ->save($path . $file_name . $ext);

        $user = Auth::user();
        $user->avatar_url = url($path . $file_name . $ext);
        $user->save();

        return response(['data' => [
            'image_url' => url($path . $file_name . $ext)
        ]], 200);
    }
}
