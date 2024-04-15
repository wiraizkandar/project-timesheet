<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    /**
     * Show the user registration form.
     */
    public function showUserRegisterPage(): \Illuminate\View\View
    {
        return view('auth.user-register');
    }

    /**
     * Store the user registration form data.
     * @param RegisterUserFormRequest $request
     */
    public function store(RegisterUserFormRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth('user')->login($user);

        return redirect()->route('user.dashboard');
    }
}
