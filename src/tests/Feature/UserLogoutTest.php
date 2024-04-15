<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLogoutTest extends TestCase
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

    public function test_user_can_logout(): void
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.logout'));

        $response->assertSee("User Login");
    }
}
