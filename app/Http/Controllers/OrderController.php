<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function checkout()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id)
            ->where('is_selected', true)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'No items selected'], 400);
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        $order = Order::create([
            'user_id' => auth()->id,
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // bersihkan cart yang sudah di-checkout
        CartItem::where('user_id', auth()->id)
            ->where('is_selected', true)
            ->delete();

        return response()->json($order->load('items'), 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
