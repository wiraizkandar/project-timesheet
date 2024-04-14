<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\User\InvalidUserLoginException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Packages\UserAuthentication;
use App\Services\AuthenticationService;

class LoginUserController extends Controller
{
    /**
     * Show the user login form.
     *
     * @return \Illuminate\View\View
     */
    public function showUserLoginPage(): \Illuminate\View\View
    {
        return view('auth.user-login');
    }

    /**
     * User Login Function to authenticate the user.
     *
     * @param LoginRequest $request
     * @return void
     */
    public function authenticate(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            (new AuthenticationService((new UserAuthentication(
                $credentials['email'],
                $credentials['password']
            ))))->login();

            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return back()->withErrors($e->errors());
            }

            if ($e instanceof InvalidUserLoginException) {
                return back()->withErrors(['message' => $e->getMessage()]);
            }

            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
}
