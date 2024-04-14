<?php

namespace App\Services;

use App\Interfaces\AuthenticationInterface;

class AuthenticationService
{
    private $auth;

    public function __construct(AuthenticationInterface $auth)
    {
        $this->auth = $auth;
    }

    public function login()
    {
        return $this->auth->login();
    }

    public function logout()
    {
    }
}
