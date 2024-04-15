<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Admin\InvalidAdminLoginException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Packages\AdminAuthentication;
use App\Services\AuthenticationService;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function showAdminLoginPage(): \Illuminate\View\View
    {
        return view('auth.admin-login');
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

            (new AuthenticationService((new AdminAuthentication(
                $credentials['email'],
                $credentials['password']
            ))))->login();

            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return back()->withErrors($e->errors());
            }

            if ($e instanceof InvalidAdminLoginException) {
                return back()->withErrors(['message' => $e->getMessage()]);
            }

            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
}
