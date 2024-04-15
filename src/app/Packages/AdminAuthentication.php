<?php

namespace App\Packages;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\Admin\InvalidAdminLoginException;
use App\Interfaces\AuthenticationInterface;


class AdminAuthentication implements AuthenticationInterface
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Authenticate a user.
     *
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function login(): bool
    {
        if (Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            // Authentication successful
            return true;
        }
        // failed authenticate user
        throw new InvalidAdminLoginException('Invalid credentials');
    }
}
