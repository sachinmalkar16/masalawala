<?php

use Illuminate\Database\Seeder;

class ProductPhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storage_path = storage_path();
        DB::table('product_photos')->insert([
            'product_id' => 1,
            'image' => $storage_path + '/products/1/zeera1.jpg',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product_photos')->insert([
            'product_id' => 2,
            'image' => $storage_path + '/products/2/coriander1.jpg',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('product_photos')->insert([
            'product_id' => 3,
            'image' => $storage_path + '/products/3/mustard.JPG',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        


    }
}
