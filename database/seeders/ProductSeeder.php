<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // 🌹 Bunga Tangkai
            ['name' => 'Mawar Merah 1 Tangkai', 'price' => 15000, 'description' => 'Satu tangkai mawar merah segar, cocok untuk hadiah simpel.', 'category' => 'Bunga Tangkai'],
            ['name' => 'Mawar Putih 1 Tangkai', 'price' => 16000, 'description' => 'Mawar putih segar melambangkan ketulusan.', 'category' => 'Bunga Tangkai'],
            ['name' => 'Tulip Mix 1 Ikat', 'price' => 250000, 'description' => 'Tulip warna-warni dalam 1 ikatan.', 'category' => 'Bunga Tangkai'],
            ['name' => 'Lili Putih 1 Ikat', 'price' => 120000, 'description' => 'Bunga lili putih segar elegan.', 'category' => 'Bunga Tangkai'],

            // 💐 Buket Bunga
            ['name' => 'Buket Mawar Merah', 'price' => 200000, 'description' => 'Buket mawar merah segar dengan wrapping cantik.', 'category' => 'Buket Bunga'],
            ['name' => 'Buket Bunga Campur', 'price' => 220000, 'description' => 'Buket kombinasi mawar merah, putih, dan pink.', 'category' => 'Buket Bunga'],
            ['name' => 'Buket Bunga Matahari', 'price' => 180000, 'description' => 'Buket bunga matahari segar dengan pita elegan.', 'category' => 'Buket Bunga'],
            ['name' => 'Buket Baby Breath', 'price' => 150000, 'description' => 'Buket bunga baby breath putih sederhana nan manis.', 'category' => 'Buket Bunga'],

            // 🎀 Karangan Bunga
            ['name' => 'Karangan Bunga Pernikahan', 'price' => 800000, 'description' => 'Karangan bunga papan ucapan selamat pernikahan.', 'category' => 'Karangan Bunga'],
            ['name' => 'Karangan Bunga Duka Cita', 'price' => 600000, 'description' => 'Karangan bunga papan untuk ucapan duka cita.', 'category' => 'Karangan Bunga'],
            ['name' => 'Karangan Bunga Grand Opening', 'price' => 750000, 'description' => 'Karangan bunga ucapan selamat pembukaan usaha.', 'category' => 'Karangan Bunga'],

            // 🌼 Standing Flower
            ['name' => 'Standing Flower Elegan', 'price' => 900000, 'description' => 'Rangkaian standing flower elegan untuk acara resmi.', 'category' => 'Standing Flower'],
            ['name' => 'Standing Flower Premium', 'price' => 1200000, 'description' => 'Standing flower premium dengan kombinasi mawar, lili, dan anggrek.', 'category' => 'Standing Flower'],

            // 🌺 Paket Dekorasi
            ['name' => 'Dekorasi Pelaminan Bunga Segar', 'price' => 5000000, 'description' => 'Dekorasi bunga segar lengkap untuk pelaminan pernikahan.', 'category' => 'Paket Dekorasi Bunga'],
            ['name' => 'Dekorasi Meja Resepsi', 'price' => 1500000, 'description' => 'Dekorasi bunga segar untuk meja resepsi acara resmi.', 'category' => 'Paket Dekorasi Bunga'],
        ];

        foreach ($products as $product) {
            $category = Category::all()->random();
            $user = User::all()->random();
            $unit = Unit::all()->random();
            $stock = rand(0, 10);

            Product::create([
                'user_id' => $user->id,
                'name' => $product['name'],
                'sku' => strtoupper(substr($category->name, 0, 3)) . '-' . strtoupper(Str::random(5)),
                'image' => 'image.jpg',
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $stock,
                'is_active' => true,
                'category_id' => $category->id,
                'unit_id' => $unit->id,
            ]);
        }
    }
}
