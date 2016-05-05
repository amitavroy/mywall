<?php

namespace App\Http\Controllers\Auth;

use App\Wall\Events\User\LoggedIn;
use App\Wall\Events\User\Logout;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JsValidator;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $loginValidationRules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['doLogout', 'getLogin', 'postLogin']]);
    }

    /**
     * Show the application login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        if (Auth::user()) {
            return redirect()->route('dashboard');
        }
        $validator = JsValidator::make($this->loginValidationRules);
        return view(settings('theme_folder') . 'user/login', compact('validator'));
    }

    /**
     * Handle the user login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = false;

        if ($request->input('remember') == 'on') {
            $remember = true;
        }

        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1], $remember)) {
            \Log::info('Login pass');

            event(new LoggedIn(Auth::user()));

            return redirect()->intended('/');
        }

        \Log::info('Login failed');

        flash()->warning('The username and password does not match.');

        return redirect()->back();
    }

    /**
     * Logout the user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doLogout()
    {
        event(new Logout());

        Auth::logout();

        return redirect('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
