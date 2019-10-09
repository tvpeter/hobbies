<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /** @test */
    public function get_registration_link_from_home_page(){
        $this->get('/')
            ->assertSee('Register');
    }   

    /** @test */
    public function user_get_registration_page(){
        $this->get('/register')
            ->assertSee('Register by filling below details');
    }

   /** @test */
    public function user_can_register(){
        
        $response = $this->post('/register', [
            'firstName' => 'Peter',
            'lastName' => 'Tyonum',
            'email' => 'withtvpeter@gmail.com',
            'phone' => '08137277480',
            'password' => 'password2019',
            'password_confirmation' => 'password2019'
        ]);

        $response->assertRedirect('/home');
        $this->assertDatabaseHas('users', [
            'email' => 'withtvpeter@gmail.com',
            'phone' => '08137277480'
        ]);
    }

    /** @test */
    public function return_error_for_invalid_data(){
        $response = $this->post('/register', [
            'lastName' => 'Tyonum',
            'email' => 'withtvpeter@gmail.com',
            'phone' => '08137277480',
            'password' => 'password2019',
            'password_confirmation' => 'password2019'
        ]);

        $response->assertSessionHasErrors();
    }
}
