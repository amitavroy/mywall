<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/9/16
 * Time: 3:40 PM
 */

namespace App\Support\Validations;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class CurrentPasswordValidation extends Validator
{
    public function validateCurrentPassword($attribute, $value, $parameters)
    {
        if (Hash::check($value, Auth::user()->password)) {
            return true;
        }

        return false;
    }
}
