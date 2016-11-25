<?php

use Illuminate\Database\Seeder;

class ProductRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_ratings')->insert([
            'product_id' => 1,
            'user_id' => 1,
            'rating' => 3,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product_ratings')->insert([
            'product_id' => 2,
            'user_id' => 1,
            'rating' => 3,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('product_ratings')->insert([
            'product_id' => 3,
            'user_id' => 1,
            'rating' => 3,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);



    }
}
