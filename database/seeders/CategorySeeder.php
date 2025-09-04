<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Category 1',
            'slug' => 'category-1',
            'image' => 'image.jpg',
            'description' => 'Description 1',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Category 2',
            'slug' => 'category-2',
            'image' => 'image.jpg',
            'description' => 'Description 2',
            'is_active' => true,
        ]);
    }
}
