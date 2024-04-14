<?php

namespace App\Interfaces;

interface AuthenticationInterface
{
    public function login();

    public function logout();
}
