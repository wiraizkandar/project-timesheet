<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutUserController extends Controller
{
    /**
     * Handle the user logout request.
     *
     * @return void
     */
    public function __invoke()
    {
        auth('user')->logout();

        return redirect()->route('user.login');
    }
}
