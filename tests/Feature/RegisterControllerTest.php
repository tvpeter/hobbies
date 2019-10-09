<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function user_get_registration_link_from_home_page(){
        $this->get('/')
            ->assertSee('Register');
    }   

    /** @test */
    public function test_user_get_registration_page(){
        $this->get('/register')
            ->assertSee('Register by filling below details');
    }

   /** @test */
    public function test_user_can_register(){
        $response = $this->post('/register', [
            'firstName' => 'Peter',
            'lastName' => 'Tyonum',
            'email' => 'withtvpeter@gmail.com',
            'phone' => '08137277480',
            'password' => 'password2019',
            'password_confirmation' => 'password2019'
        ]);

        $this->assertCount(1, User::all());
    }
}
