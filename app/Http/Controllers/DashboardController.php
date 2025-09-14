<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $categories = Category::all();
        $products = Product::all();

        // Ambil kategori dengan jumlah produk
        $categoriesWithCount = Category::withCount('products')->get();

        // Ambil data untuk chart
        $categoryNames = $categoriesWithCount->pluck('name');        // label chart
        $productCounts = $categoriesWithCount->pluck('products_count'); // value chart


        return view('admin.index', compact('users', 'categories', 'products', 'categoryNames', 'productCounts'));
    }
}
