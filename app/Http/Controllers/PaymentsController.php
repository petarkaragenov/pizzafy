<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Order;
use App\OrderItem;

class PaymentsController extends Controller
{
    public function charge(Request $request) {
        $token = json_decode($request->token);
        $items = json_decode($request->items, true);
        $orderItems = json_decode($request->orderItems, true);
        $user = json_decode($request->user);

        $stripe = Stripe::make(env('STRIPE_SECRET'));
        $customer = $stripe->customers()->create([
            'email' => $token->email
        ]);

        $card = $stripe->cards()->create($customer['id'], $token->id);

        $order = $stripe->orders()->create([
            'customer' => $customer['id'],
            'currency' => 'usd',
            'items' => array_values($orderItems),
            'shipping' => [
                'name'    => $user->name,
                'address' => [
                    'line1'       => $user->address,
                    'city'        => $user->city,
                    'country'     => 'USSR',
                    'postal_code' => $user->zip,
                ],
            ],
            'email' => $token->email
        ]);

        Order::create([
            'id' => $order['id'],
            'user_id' => $user->id,
            'status' => 'Received',
            'amount' => $request->totalPrice
        ]);

        foreach($items as $item) {
            OrderItem::create([
                'order_id' => $order['id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['total']
            ]);
        }

        $message = [
            'first' => "Your order with an id of {$order['id']} was submitted successfully",
            'second' => "You can always check its status under Profile > Orders"
        ];

        return response()->json($message);
    }
}
