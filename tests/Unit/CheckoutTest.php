<?php

use App\Http\Controllers\Site\CheckoutController;
use App\Repositories\OrderRepository;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mockery;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    protected $orderRepository;
    protected $payPal;
    protected $checkoutController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->orderRepository = Mockery::mock(OrderRepository::class);
        $this->payPal = Mockery::mock(PayPalService::class);
        $this->checkoutController = new CheckoutController($this->orderRepository, $this->payPal);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testPlaceOrderWithValidOrder()
    {
        $requestData = ['item' => 'example'];

        $this->orderRepository
            ->shouldReceive('storeOrderDetails')
            ->once()
            ->with($requestData)
            ->andReturn(true);

        $this->payPal
            ->shouldReceive('processPayment')
            ->once()
            ->withArgs(function ($order) use ($requestData) {
                // Additional assertions can be added here based on the order and requestData
                return true;
            });

        $response = $this->checkoutController->placeOrder(new Request($requestData));

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('Order not placed', $response->getSession()->get('message'));
    }
}
