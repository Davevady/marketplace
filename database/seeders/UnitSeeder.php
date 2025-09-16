<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['name' => 'Piece', 'symbol' => 'pcs', 'is_active' => true],
            ['name' => 'Kilogram', 'symbol' => 'kg', 'is_active' => true],
            ['name' => 'Liter', 'symbol' => 'l', 'is_active' => true],
            ['name' => 'Box', 'symbol' => 'box', 'is_active' => true],
            ['name' => 'Pack', 'symbol' => 'pack', 'is_active' => true],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
