<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Login extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/login',
        [
            'email' => "adminCabang1@gmail.com",
            'password' => "12345678"
        ]
    );

        $response->assertRedirect('/tampilanmenu');
    }
}
