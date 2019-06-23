<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderItem;

class OrdersController extends Controller
{
    public function index() {
        return response()->json(Order::orderBy('created_at', 'desc')->get());
    }

    public function user_orders($id) {
        return response()->json(Order::orderBy('created_at', 'desc')->where('user_id', '=', $id)->get());
    }

    public function show(Order $order) {
        return response()->json($order);
    }

    public function update(Request $request, Order $order) {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json($order);
    }

    public function show_items($id) {
        return response()->json(OrderItem::where('order_id', '=', $id)->get());
    }

    public function show_customer($id) {
        return response()->json(Order::find($id)->user);
    }

    public function destroy(Order $order) {
        $order->delete();

        return response()->json(Order::all());
    }
}
