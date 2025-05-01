<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_items' => 'required|json',
            'total' => 'required|numeric',
        ], [
            'cart_items.required' => 'Cart data is required.',
            'cart_items.json' => 'Cart items must be in valid JSON format.',
            'total.required' => 'Total is required.',
        ]);

        if ($validator->fails()) {
            sweetalert()->error($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cartItems = json_decode($request->cart_items, associative: true);

        Order::create([
            'customer_id' => Auth::id(),
            'items' => $cartItems,
            'total' => $request->total,
            'status' => 'pending',
            'date_ordered' => now(),
        ]);

        sweetalert()->success('Your order has been placed successfully.');
        return redirect()->route('home', [], 303)->with('clear_cart', true);
    }
}
