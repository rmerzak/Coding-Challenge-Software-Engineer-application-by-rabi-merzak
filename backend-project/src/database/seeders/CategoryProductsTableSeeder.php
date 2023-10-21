<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('category_products')->insert([
            [
                'id' => 7,
                'category_id' => 1,
                'product_id' => 17,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'category_id' => 2,
                'product_id' => 17,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'category_id' => 1,
                'product_id' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'category_id' => 3,
                'product_id' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'category_id' => 4,
                'product_id' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'category_id' => 5,
                'product_id' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'category_id' => 6,
                'product_id' => 23,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'category_id' => 4,
                'product_id' => 23,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}