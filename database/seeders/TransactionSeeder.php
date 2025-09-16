<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Invoice;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();
        $products = Product::take(5)->get();

        // 1️⃣ Cart belum checkout
        foreach ($products->take(2) as $product) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => rand(1, 3),
                'is_selected' => false,
            ]);
        }

        // 2️⃣ Sudah checkout tapi belum bayar
        $checkoutProducts = $products->slice(2, 2);
        $totalUnpaid = 0;

        $orderUnpaid = Order::create([
            'user_id' => $user->id,
            'total_amount' => 0,
            'status' => 'pending', // belum dibayar
        ]);

        foreach ($checkoutProducts as $product) {
            $qty = rand(1, 2);
            $subtotal = $qty * $product->price;
            $totalUnpaid += $subtotal;

            OrderItem::create([
                'order_id' => $orderUnpaid->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ]);
        }

        $orderUnpaid->update(['total_amount' => $totalUnpaid]);

        // bikin invoice untuk order unpaid
        $invoiceUnpaid = Invoice::create([
            'order_id' => $orderUnpaid->id,
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'amount' => $totalUnpaid,
            'status' => 'pending',
            'due_date' => now()->addDays(1),
        ]);

        // 3️⃣ Sudah checkout dan sudah dibayar
        $checkoutPaid = $products->slice(4, 1);
        $totalPaid = 0;

        $orderPaid = Order::create([
            'user_id' => $user->id,
            'total_amount' => 0,
            'status' => 'paid',
        ]);

        foreach ($checkoutPaid as $product) {
            $qty = rand(1, 3);
            $subtotal = $qty * $product->price;
            $totalPaid += $subtotal;

            OrderItem::create([
                'order_id' => $orderPaid->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ]);
        }

        $orderPaid->update(['total_amount' => $totalPaid]);

        // bikin invoice untuk order paid
        $invoicePaid = Invoice::create([
            'order_id' => $orderPaid->id,
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'amount' => $totalPaid,
            'status' => 'paid',
            'due_date' => now()->addDays(1),
        ]);

        // bikin payment untuk invoice paid
        Payment::create([
            'order_id' => $orderPaid->id,
            'invoice_id' => $invoicePaid->id,
            'method' => 'bank_transfer',
            'amount' => $totalPaid,
            'status' => 'success',
            'transaction_code' => 'TRX-' . strtoupper(uniqid()),
        ]);
    }
}
