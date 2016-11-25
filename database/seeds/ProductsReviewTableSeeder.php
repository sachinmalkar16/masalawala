<?php

use Illuminate\Database\Seeder;

class ProductsReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_reviews')->insert([
            'comment'=> 'first review',
            'product_id' => 1,
            'parent_id' => 0,
            'user_id' => 1,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

        ]);

        DB::table('product_reviews')->insert([
            'comment'=> 'first review',
            'product_id' => 2,
            'parent_id' => 0,
            'user_id' => 1,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

        ]);

        DB::table('product_reviews')->insert([
            'comment'=> 'first review',
            'product_id' => 3,
            'parent_id' => 0,
            'user_id' => 1,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

        ]);

      
    }
}
