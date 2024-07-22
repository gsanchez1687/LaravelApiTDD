<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\bcrypt;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   /* public function test_login(): void
    {
        $user = User::factory()->create([
            'email' => 'gsanchez' . time() . '@gmail.com',
            'password' => bcrypt('123456')
        ]);
        

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '123456'
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
        
    }*/

    public function test_register(): void
    {
        //lo que se envia en el post
        $response = $this->post('/api/register', [
            'name' => 'Gustavo',
            'email' => 'gsanchez' . time() . '@gmail.com',
            'password' => '123456'
        ]);

        //lo que esperamos
        $response->assertStatus(200);
    }
}
