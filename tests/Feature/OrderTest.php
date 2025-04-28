<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_successfully_places_order()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);

        $cartItems = [
            ['product_id' => 1, 'quantity' => 2],
            ['product_id' => 2, 'quantity' => 1]
        ];

        $payload = [
            'cart_items' => json_encode($cartItems),
            'subtotal' => 100.00, // Not stored in DB
            'shipping' => 10.00,   // Not stored in DB
            'tax' => 5.00,         // Not stored in DB
            'total' => 115.00,
        ];

        $response = $this->post(route('checkout'), $payload);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('clear_cart', true);

        $this->assertDatabaseHas('orders', [
            'customer_id' => $user->_id,
            'total' => 115.00,
            'status' => 'pending',
        ]);

        $order = Order::first();
        $this->assertEquals($cartItems, $order->items);
    }

    public function test_checkout_fails_with_invalid_data()
    {
        $user = User::create([
            'name' => 'Fail User',
            'email' => 'fail@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);

        $payload = [
            'cart_items' => 'not-json',
            'subtotal' => 100.00,
            'shipping' => 10.00,
            'tax' => 5.00,
            // Missing total
        ];

        $response = $this->from('/checkout')->post(route('checkout'), $payload);

        $response->assertRedirect('/checkout');
        $response->assertSessionHasErrors(['cart_items', 'total']);
    }
}
