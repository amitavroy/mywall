<?php

namespace App;

use App\Presenters\UserPresenter;
use App\Support\FileManager;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait, PresentableTrait;

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

    /**
     * Relation between User and Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * Handle the user profile picture update
     *
     * @param Request $request
     */
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
