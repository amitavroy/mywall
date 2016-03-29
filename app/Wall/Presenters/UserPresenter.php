<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/11/16
 * Time: 11:23 PM
 */

namespace App\Wall\Presenters;


use App\Support\FileManager;
use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Show the user display name
     *
     * @return mixed|string
     */
    public function displayName()
    {
        if ($this->name) {
            return $this->name;
        }

        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }
    }

    /**
     * Display the avatar of the user
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function avatar()
    {
        if ($this->avatar_url != null && $this->avatar_url != '') {
            $fm = new FileManager;
            return $fm->uriToUrl($this->avatar_url);
        }

        return url('admin_lte/img/anonymous.jpg');
    }

    public function memberSince()
    {
        return Carbon::parse($this->created_at)->format('F, Y');
    }
}
