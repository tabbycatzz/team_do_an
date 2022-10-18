<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\User\BaseRequest;

class ForgotPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|max:30'
        ];
    }

    public function messages()  
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Password must be at most 30 characters'
        ];
    }
}
