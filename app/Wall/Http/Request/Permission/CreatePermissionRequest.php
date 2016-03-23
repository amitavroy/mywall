<?php

namespace App\Wall\Http\Request\Permission;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreatePermissionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->can('manage-role-perm')) {
            return true;
        }
        return false;
    }

    /**
     * Get the messages that apply to the request rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required for the Permission.',
            'display_name.required' => 'This field is required for displaying purpose.',
            'description.required' => 'You need to enter a short description of what this permission does.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:permissions,name',
            'display_name' => 'required',
            'description' => 'required:min:5'
        ];
    }
}
