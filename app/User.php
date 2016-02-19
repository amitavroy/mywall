<?php

namespace App;

use App\Presenters\UserPresenter;
use App\Support\FileManager;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\PresentableTrait;

class User extends Authenticatable
{
    use PresentableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $presenter = UserPresenter::class;

    public function handleUserProfilePicUpdate(Request $request)
    {
        $this->removeOldProfileImage();
    }

    private function removeOldProfileImage()
    {
        if (Auth::user()->avatar_url != '') {
            $fm = new FileManager;
            $fm->removeFile(Auth::user()->avatar_url);
        }
    }
}
