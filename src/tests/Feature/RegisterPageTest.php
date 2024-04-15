<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    public function test_can_view_user_register_page(): void
    {
        $response = $this->get('/user/register');

        $response->assertStatus(200);
    }
}
