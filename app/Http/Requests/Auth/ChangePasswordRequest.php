<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\User\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'old_password' => 'required',
            'password' => 'required|min:6|max:30',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages()  
    {
        return [
            'password.required' => 'Please enter a password',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must be at most 30 characters',
            'confirm_password.required' => 'Please enter the confirmation password',
            'confirm_password.same' => 'Does not match the password entered above'
        ];
    }
}
