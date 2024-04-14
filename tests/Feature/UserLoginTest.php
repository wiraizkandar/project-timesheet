<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    private function createUser(): User
    {
        return User::factory()->create([
            'name' => 'Wira Izkandar',
            'email' => 'wiraizkandar1@gmail.com',
            'password' => bcrypt('Wira1234')
        ]);
    }

    public function test_user_success_login(): void
    {
        $response = $this->post(route('user.authenticate'), [
            'email' => 'wiraizkandar1@gmail.com',
            'password' => 'Wira1234',
        ]);

        $response->assertRedirect(route('user.dashboard'));
    }

    public function test_user_invalid_login(): void
    {
        $response = $this->post(route('user.authenticate'), [
            'email' => 'wiraizkandar123@gmail.com',
            'password' => 'Wira1234',
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Invalid credentials'
        ]);
    }

    public function test_user_login_incomplete_required_fields(): void
    {
        $response = $this->post(route('user.authenticate'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertInvalid([
            'email' => 'The email field is required.',
            'password' => 'The password field is required',
        ]);
    }
}
