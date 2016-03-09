<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required|min:5|currentPassword:current_password',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|min:5|same:new_password',
        ];
    }

    /**
     * Set the custom messages that will be shown for validations
     *
     * @return array
     */
    public function messages()
    {
        return [
            'current_password.required' => 'Your current password is required',
            'current_password.min' => 'Your current password cannot be less than 5 characters',
            'current_password.current_password' => 'This is not your current password',
            'new_password.required' => 'Please add a new password',
            'new_password.min' => 'Your new password should be at least 5 characters long.',
            'confirm_password.same' => 'The two password should match',
        ];
    }
}
