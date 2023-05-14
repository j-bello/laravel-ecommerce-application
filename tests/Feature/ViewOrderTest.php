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
     $user = User::factory()->create();
     $this->actingAs($user);

     $response = $this->get(route('account.orders'));

     $response->assertStatus(200);

     $response->assertViewIs('site.pages.account.orders');

     $response->assertViewHas('orders');

     }

     /** @test */
    public function it_redirects_to_login_page_when_user_is_not_logged_in()
    {
        $response = $this->get(route('account.orders'));

        $response->assertRedirect(route('login'));
    }



}
