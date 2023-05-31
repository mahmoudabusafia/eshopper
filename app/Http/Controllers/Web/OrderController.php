<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('web.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        $cart = Cart::where('user_id', $order->user_id)->get();
        return view('web.orders.show', [
            'order' => $order,
            'cart' => $cart
        ]);
    }

}
