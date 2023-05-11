<?php

namespace Tests\Unit;
//use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    //use RefreshDatabase;

   /** @test */

    public function it_can_create_an_order()
    {
        $data = [
            'order_number' => 'ORD-00121111111111',
            'user_id' => 2,
            'status' => 'pending',
            'grand_total' => 100.00,
            'item_count' => 3,
            'payment_status' => 1,
            'payment_method' => 'Paypal-',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
            'country' => 'USA',
            'post_code' => '10001',
            'phone_number' => '555-1234',
            'notes' => 'Sample order notes',
        ];

        $order = Order::create($data);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($data['order_number'], $order->order_number);
        $this->assertEquals($data['user_id'], $order->user_id);
        $this->assertEquals($data['status'], $order->status);
        $this->assertEquals($data['grand_total'], $order->grand_total);
        $this->assertEquals($data['item_count'], $order->item_count);
        $this->assertEquals($data['payment_status'], $order->payment_status);
        $this->assertEquals($data['payment_method'], $order->payment_method);
        $this->assertEquals($data['first_name'], $order->first_name);
        $this->assertEquals($data['last_name'], $order->last_name);
        $this->assertEquals($data['address'], $order->address);
        $this->assertEquals($data['city'], $order->city);
        $this->assertEquals($data['country'], $order->country);
        $this->assertEquals($data['post_code'], $order->post_code);
        $this->assertEquals($data['phone_number'], $order->phone_number);
        $this->assertEquals($data['notes'], $order->notes);
    }








}
