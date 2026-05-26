<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_successfully()
    {
        $response = $this->post('/register', [
            'name' => 'Najwa',
            'email' => 'najwa@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'email' => 'najwa@test.com',
        ]);
    }

    /** @test */
    public function user_is_logged_out_after_registration()
    {
        $this->post('/register', [
            'name' => 'Najwa',
            'email' => 'logout@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertGuest();
    }
}
