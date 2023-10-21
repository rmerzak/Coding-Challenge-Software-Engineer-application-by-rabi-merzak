<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 17,
                'name' => 'iPhone',
                'description' => 'Apple\'s latest smartphone',
                'price' => 799.99,
                'image' => 'images/iphone.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'name' => 'Dell XPS 13',
                'description' => 'High-performance laptop',
                'price' => 1299.30,
                'image' => 'images/dell-xps.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'name' => 'T-shirt',
                'description' => 'Basic cotton t-shirt',
                'price' => 12.90,
                'image' => 'images/tshirt.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 23,
                'name' => 'Dress',
                'description' => 'Elegant evening dress',
                'price' => 120.99,
                'image' => 'images/dress.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}