<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function user_get_login_link_from_home_page(){
        $this->get('/')
            ->assertSee('Login');
    }   

    /** @test */
    public function user_get_login_form(){
        $this->get('/login')
            ->assertSee('Login');
    }

  /** @test */
  public function login_displays_validation_errors()
  {
      $response = $this->post('/login', []);
      $response->assertStatus(302);
      $response->assertSessionHasErrors('email');
  }

  /** @test */
  public function login_authenticates_and_redirects_user()
  {
      $user = factory(User::class)->create();
      $response = $this->post(route('login'), [
          'email' => $user->email,
          'password' => 'password'
      ]);
      $response->assertRedirect(route('home'));
      $this->assertAuthenticatedAs($user);
  }
}
