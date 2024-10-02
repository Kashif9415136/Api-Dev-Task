<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->only([
            'product_id',
            'quantity',
            'product' ,
        ]);

        if(!empty($request->product))
        {
            $product = Product::where('name', $request->product)->first();

        }

        if ($product == null) {
            return response()->json(['message' => 'Product not found'], 404);
        }


        $order = Order::create([
            'user_id' => $request->user()->id,
            'product_id' => $product->id ?? $request->product_id,
            'quantity' => $request->quantity,
        ]);


        return response()->json($order, 201);
    }

    public function getorders(Request $request)
    {
        $orders = Order::get();
        return response()->json($orders, 200);
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $user = auth()->user();

        if(!$user->is_admin)
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        $order = Order::findorfail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return response()->json($order, 200);
    }


}
