<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * @route /api/orders
     * @method GET
     * @desc Get User orders
     */
    public function index(Request $request) 
    {
        $order = NULL;
        if ($request->user()->isAdmin) {
            $order = Order::all()->groupBy('cart_id');
        } else {
            $order = $request->user()->orders->groupBy('cart_id');
        }
        return $order;
    }
    /**
     * @route /api/orders
     * @method POST
     * @desc Save user order
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'cart_id' => 'required',
            'quantity' => 'required'
        ]);
        $order = Order::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => $request->user()->id,
            'cart_id' => $request->cart_id
        ]);
        return $order;
    }
}
