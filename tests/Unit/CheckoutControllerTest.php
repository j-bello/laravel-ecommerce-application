<?php

namespace Tests\Unit\Controllers\Site;

use Tests\TestCase;
use Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Testing\Concerns\InteractsWithSession;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\PayPalService;
use App\Contracts\OrderContract;
use App\Http\Controllers\Site\CheckoutController;
use Illuminate\Foundation\Testing\TestResponse;
use App\Providers\RouteServiceProvider;


class CheckoutControllerTest extends TestCase
{
    protected $orderRepository;
    protected $payPal;
    protected $checkoutController;

    public function setUp(): void
    {
        parent::setUp();

        // Set the facade root for Cart
        $this->app->instance(Cart::class, Cart::clear());

        $this->orderRepository = $this->mock(OrderContract::class);
        $this->payPal = $this->mock(PayPalService::class);
        $this->checkoutController = new CheckoutController($this->orderRepository, $this->payPal);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Cart::clear();
    }

    public function testGetCheckout()
    {
        $response = $this->checkoutController->getCheckout();

        $this->assertEquals('site.pages.checkout', $response->getName());
    }



 
}
