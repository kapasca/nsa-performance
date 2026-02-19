<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'NSA Cover Radiator Titanium Mesh V1',
                'slug' => Str::slug('NSA Cover Radiator Titanium Mesh V1'),
                'price' => 2500000,
                'discount_price' => 2200000,
                'description' => 'High performance radiator cover with titanium mesh.',
                'image' => 'cover-radiator-titanium.jpg',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NSA Cover Knalpot Vexor All Motor',
                'slug' => Str::slug('NSA Cover Knalpot Vexor All Motor'),
                'price' => 4800000,
                'discount_price' => null,
                'description' => 'Premium exhaust cover for all motor setups, designed for optimal performance.',
                'image' => 'cover-knalpot.jpg',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NSA Radiator Guard Aero Vietnam',
                'slug' => Str::slug('NSA Radiator Guard Aero Vietnam'),
                'price' => 3500000,
                'discount_price' => 3000000,
                'description' => 'Custom radiator guard for enhanced aerodynamics and protection.',
                'image' => 'cover-radiator-aero.jpg',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
