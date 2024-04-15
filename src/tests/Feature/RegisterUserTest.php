<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_new_user_stored(): void
    {
        $response = $this->post(route('user.register'), [
            'name' => 'Wira Izkandar',
            'email' => 'wiraizkandar1@gmail.com',
            'password' => 'Wira1234',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'wiraizkandar1@gmail.com'
        ]);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_register_new_user_set_as_authenticated(): void
    {
        $response = $this->post(route('user.register'), [
            'name' => 'Wira Izkandar',
            'email' => 'wiraizkandar1@gmail.com',
            'password' => 'Wira1234',
        ]);

        $this->assertAuthenticated('user');
    }

    public function test_register_new_user_redirected_to_dashboard_user(): void
    {
        $response = $this->post(route('user.register'), [
            'name' => 'Wira Izkandar',
            'email' => 'wiraizkandar1@gmail.com',
            'password' => 'Wira1234',
        ]);

        $response->assertRedirect(route('user.dashboard'));
    }
}
