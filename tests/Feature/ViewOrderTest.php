<?php

namespace Tests\Feature;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class ViewOrderTest extends TestCase
{
 use WithFaker;


     /** @test */
     public function account_order_page_can_be_rendered()
     {
     // Create a user and log them in
     $user = User::factory()->create();
     $this->actingAs($user);

     // Perform a GET request to the 'account.orders' route
     $response = $this->get(route('account.orders'));

     // Assert that the response has a successful status code
     $response->assertStatus(200);

     // Assert that the returned view is the expected view
     $response->assertViewIs('site.pages.account.orders');

     // Assert that the 'orders' variable is passed to the view
     $response->assertViewHas('orders');

     }

     /** @test */
    public function it_redirects_to_login_page_when_user_is_not_logged_in()
    {
        // Perform a GET request to the 'account.orders' route
        $response = $this->get(route('account.orders'));

        // Assert that the response is a redirect
        $response->assertRedirect(route('login'));
    }



}
