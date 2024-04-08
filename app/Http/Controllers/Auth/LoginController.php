<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showAdminLoginPage()
    {
        return view('auth.admin-login', ['url' => 'admin']);
    }

    public function showUserLoginPage()
    {
        return view('auth.user-login', ['url' => 'user']);
    }
}
