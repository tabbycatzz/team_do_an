<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Services\User\ChangePasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct(ChangePasswordService $changePasswordService)
    {
        $this->changePasswordService = $changePasswordService;
    }

    /**
     * Show change password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        $user = $this->changePasswordService->getUserProfile();
        $postViewed = $this->changePasswordService->postViewed();

        return view('user.profile.form.ChangePassword', compact('user', 'postViewed'));
    }

    /**
     * Change new password user account
     *
     * @param \App\Http\Requests\Auth\ChangePasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function saveNewPassword(ChangePasswordRequest $request)
    {
        if ($this->changePasswordService->changePassword($request)) {
            return redirect()->back()->with('success', __('messages.change_password.change_password_success'));
        }
        
        return redirect()->back()->with('error', __('messages.change_password.change_password_fail'));
    }
}
