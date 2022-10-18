<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UserRequest;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except(['logout', 'login']);
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    /**
     * Show login form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Redirect::setIntendedUrl(url()->previous());
        
        return view('user.auth.login');
    }

    /**
     * Log in to account
     *
     * @param \App\Http\Requests\Auth\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', __('messages.login.email_not_exist'));
        }

        if(!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', __('messages.login.password_wrong'));
        }

        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (!($this->guard()->user()->role == UserRole::USER)) {
                $this->guard()->logout();

                return redirect()->route('login')->with('error', __('auth.unauthorized'));
            } elseif (!($this->guard()->user()->status == UserStatus::ACTIVE)) {
                $this->guard()->logout();

                return redirect()->route('login')->with('error', __('auth.account_locked'));
            } else {
                return redirect()->intended(RouteServiceProvider::HOME)->with('success', __('messages.login.success'));
            }
        } else {
            return redirect()->back()->with('error', __('messages.login.error'));
        }
    }

    /**
     * Sign out of account
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->guard()->logout();
        Redirect::setIntendedUrl(url()->previous());
        
        return redirect()->intended(RouteServiceProvider::HOME)->with('success', __('messages.logout'));
    }
}
