<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bunga Tangkai',
                'image' => 'bunga-tangkai.jpg',
                'description' => 'Aneka bunga potong per tangkai atau per ikatan.',
            ],

            [
                'name' => 'Buket Bunga',
                'image' => 'buket-bunga.jpg',
                'description' => 'Rangkaian buket bunga segar untuk hadiah spesial.',
            ],

            [
                'name' => 'Karangan Bunga',
                'image' => 'karangan-bunga.jpg',
                'description' => 'Karangan bunga papan untuk pernikahan, duka cita, atau ucapan selamat.',
            ],

            [
                'name' => 'Standing Flower',
                'image' => 'standing-flower.jpg',
                'description' => 'Rangkaian bunga berdiri elegan untuk dekorasi acara.',
            ],

            [
                'name' => 'Paket Dekorasi Bunga',
                'image' => 'paket-dekorasi.jpg',
                'description' => 'Dekorasi bunga lengkap untuk pernikahan dan event lainnya.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'image' => $category['image'],
                'description' => $category['description'],
                'is_active' => true,
            ]);
        }
    }
}
