<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_can_view_user_login_page(): void
    {
        $response = $this->get(route('user.login'));

        $response->assertSee("User Login");
    }
}
