<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_view_homepage(): void
    {
        $response = $this->get('/');

        $response->assertSee("Admin Login");
        $response->assertStatus(200);
    }

    public function test_can_view_admin_login_page(): void
    {
        $response = $this->get('/admin/login');

        $response->assertSee("Admin Login");
    }

    public function test_can_view_user_login_page(): void
    {
        $response = $this->get('/user/login');

        $response->assertSee("User Login");
    }
}
