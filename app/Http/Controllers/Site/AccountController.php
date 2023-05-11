<?php

namespace App\Http\Controllers\Site;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function getOrders()
    {
        //$orders = auth()->user()->orders;
        $orders = Order::all();
        return view('site.pages.account.orders', compact('orders'));
    }
}











