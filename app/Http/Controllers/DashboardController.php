<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $products = Product::all();
        $paidTotal = Order::where('status', 'paid')->sum('total_amount');
        $paidCount = Order::where('status', 'paid')->count();
        $pendingCount = Order::where('status', 'pending')->count();

        $latestOrders = Order::with(['user', 'items'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'user_name' => $order->user->name,
                    'total_items' => $order->items->sum('quantity'),
                    'total_amount' => $order->total_amount,
                    'created_at' => $order->created_at,
                    'status' => $order->status,
                ];
            });

        // Ambil total transaksi per bulan (dari tabel orders)
        $salesPerMonth = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('total', 'month'); // hasil: [1 => 1000000, 2 => 2000000, ...]

        // Buat array 12 bulan, isi default 0
        $salesData = array_fill(1, 12, 0);

        // Isi data sesuai hasil query
        foreach ($salesPerMonth as $month => $total) {
            $salesData[$month] = $total;
        }

        $salesData = array_values($salesData);

        // Ambil kategori dengan jumlah produk
        $categoriesWithCount = Category::withCount('products')->get();

        // Ambil 5 produk terbaru
        $latestProducts = Product::latest()->take(5)->get();

        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')
            ->orderBy('stock', 'asc')
            ->take(10) // misalnya ambil 10 produk terendah
            ->get();

        // Produk terlaris (top 5 berdasarkan total quantity di order items)
        $bestSellingProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $bestProductNames = $bestSellingProducts->pluck('name');
        $bestProductTotals = $bestSellingProducts->pluck('total_sold');


        return view('admin.index', compact(
            'users',
            'products',
            'paidTotal',
            'paidCount',
            'pendingCount',
            'latestOrders',
            'salesData',
            'latestProducts',
            'lowStockProducts',
            'bestProductNames',
            'bestProductTotals',
        ));
    }

    public function transaction()
    {
        return view('admin.transaction');
    }
}
