<?php

namespace App\Wall\Http\Request\Role;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateRoleRequest extends Request
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required:min:5'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required for the Role.',
            'display_name.required' => 'This field is required for displaying purpose.',
            'description.required' => 'You need to enter a short description of what this role does.'
        ];
    }
}
