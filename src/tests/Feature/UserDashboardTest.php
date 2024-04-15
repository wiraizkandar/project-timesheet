<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class UserDashboardTest extends TestCase
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
        return User::factory()->create();
    }

    public function test_user_dashboard_cannot_be_access_without_login(): void
    {
        $response = $this->get('/user/dashboard');

        $response->assertRedirect(route('home'));
    }

    public function test_user_dashboard_can_be_access_by_authenticated_user(): void
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.dashboard'));

        $response->assertOk();
    }
}
