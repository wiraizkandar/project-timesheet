<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_can_view_homepage(): void
    {
        $response = $this->get('/');

        $response->assertSee("Admin Login");
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
