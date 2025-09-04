<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $category = Category::all()->random();
            $user = User::all()->random();
            Product::create([
                'user_id' => $user->id,
                'name' => 'Product ' . $i,
                'slug' => 'product-' . $i,
                'image' => 'image.jpg',
                'description' => 'Description Product ' . $i,
                'price' => $i * 100,
                'is_active' => true,
                'category_id' => $category->id,
            ]);
        }
    }
}
