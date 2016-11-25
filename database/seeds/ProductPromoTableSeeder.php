<?php

use Illuminate\Database\Seeder;

class ProductPromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_promo')->insert([
            'product_id' => 1,
            'promo_code' => 'MASALA100',
            'expiry_date' => date('Y-m-d H:i:s', strtotime('16/11/2016')),
            'total_promo' => 5,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product_promo')->insert([
            'product_id' => 1,
            'promo_code' => 'MASALA100',
            'expiry_date' => date('Y-m-d H:i:s', strtotime('16/11/2016')),
            'total_promo' => 5,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product_promo')->insert([
            'product_id' => 1,
            'promo_code' => 'MASALA100',
            'expiry_date' => date('Y-m-d H:i:s', strtotime('16/11/2016')),
            'total_promo' => 5,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

       
    }
}
