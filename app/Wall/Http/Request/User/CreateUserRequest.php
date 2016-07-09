<?php

namespace App\Wall\Http\Request\User;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->can('manage-users')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        if (settings('send_password_through_mail') == "false") {
            $rules['password'] = 'required|min:5';
            $rules['cpassword'] = 'required|min:5|same:password';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'We need to know your name.',
            'name.min' => 'Your name is too small.',
        ];
    }
}
