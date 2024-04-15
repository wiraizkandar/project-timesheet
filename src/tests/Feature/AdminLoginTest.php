<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->createAdmin();
    }

    private function createAdmin(): Admin
    {
        return Admin::factory()->create([
            'name' => 'Wira Izkandar',
            'email' => 'wiraizkandar1@gmail.com',
            'password' => bcrypt('Wira1234')
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_can_view_admin_login_page(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
    }

    public function test_invalid_admin_login(): void
    {
        $response = $this->post(route('admin.authenticate'), [
            'email' => 'wiraizkandar123@gmail.com',
            'password' => 'Wira1234',
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Invalid credentials'
        ]);
    }

    public function test_admin_success_login(): void
    {
        $response = $this->post(route('admin.authenticate'), [
            'email' => 'wiraizkandar1@gmail.com',
            'password' => 'Wira1234',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_login_incomplete_required_fields(): void
    {
        $response = $this->post(route('admin.authenticate'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertInvalid([
            'email' => 'The email field is required.',
            'password' => 'The password field is required',
        ]);
    }
}
