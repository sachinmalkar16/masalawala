<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert([
            'product_name' => 'Cummin',
            'indian_name' => 'Zeera',
            'description' => 'Cummin is a flowering plant in the family Apiaceae, native from the east Mediterranean to South Asia.',
            'product_category_id' => 1,
            'price' => 250,
            'unit' => 'Kg',
            'market_price' => '400',
            'bulk_quantity' => 5,
            'bulk_discount' => 4,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

        ]);
        DB::table('products')->insert([
            'product_name' => 'Cooriander',
            'indian_name' => 'Cooriander',
            'description' => 'Dhania',
            'product_category_id' => 1,
            'price' => 250,
            'unit' => 'Kg',
            'market_price' => '400',
            
            'bulk_quantity' => 5,
            'bulk_discount' => 4,
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

        ]);
        DB::table('products')->insert([
                'product_name' => 'Mustard',
                'indian_name' => 'Rai',
                'description' => 'mustard',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Long',
                'indian_name' => 'Long',
                'description' => 'Long',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Choti Elechi',
                'indian_name' => 'Choti Elechi',
                'description' => 'Choti Elechi',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Methi',
                'indian_name' => 'Methi',
                'description' => 'Methi',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Ajwian',
                'indian_name' => 'Ajwian',
                'description' => 'Ajwian',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Badi Elichi',
                'indian_name' => 'Badi Elichi',
                'description' => 'Badi Elichi',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Khaskhas',
                'indian_name' => 'Khaskhas',
                'description' => 'Khaskhas',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Till White',
                'indian_name' => 'Khaskhas',
                'description' => 'Till White',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Alshi',
                'indian_name' => 'Khaskhas',
                'description' => 'Alshi',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'kokam',
                'indian_name' => 'Khaskhas',
                'description' => 'kokam',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Khaman',
                'indian_name' => 'Khaskhas',
                'description' => 'Khaman',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Dal Chini',
                'indian_name' => 'Khaskhas',
                'description' => 'Dal Chini',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Mishri',
                'indian_name' => 'Khaskhas',
                'description' => 'Mishri',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Jaifal',
                'indian_name' => 'Khaskhas',    
                'description' => 'Jaifal',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
        DB::table('products')->insert([
                'product_name' => 'Soaf Rosted',
                'indian_name' => 'Khaskhas',    
                'description' => 'Soaf Rosted',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Badi soaf',
                'indian_name' => 'Khaskhas',
                'description' => 'Badi soaf',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Sapja',
                'indian_name' => 'Khaskhas',
                'description' => 'Sapja',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Tezpatta',
                'indian_name' => 'Khaskhas',
                'description' => 'Tezpatta',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Sabut Lal Mirch',
                'indian_name' => 'Khaskhas',
                'description' => 'Sabut Lal Mirch',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Kalonji',
                'indian_name' => 'Khaskhas',
                'description' => 'Kalonji',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Black Paper Powder',
                'indian_name' => 'Khaskhas',
                'description' => 'Black Paper Powder',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Dry Ginjer Powder',
                'indian_name' => 'Khaskhas',
                'description' => 'Dry Ginjer Powder',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Zeera Powder',
                'indian_name' => 'Khaskhas',
                'description' => 'Zeera Powder',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Sandha Salt',
                'indian_name' => 'Khaskhas',
                'description' => 'Sandha Salt',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Dri Mango Powder',
                'indian_name' => 'Khaskhas',
                'description' => 'Dri Mango Powder',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Sanchar Powder',
                'indian_name' => 'Khaskhas',
                'description' => 'Sanchar Powder',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Turmeric',
                'indian_name' => 'Khaskhas',
                'description' => 'Turmeric',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Javitri',
                'indian_name' => 'Khaskhas',
                'description' => 'Javitri',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Dhaniya Dal',
                'indian_name' => 'Dhaniya Dal',
                'description' => 'Dhaniya Dal',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]);
            DB::table('products')->insert([
                'product_name' => 'Barley', 
                'indian_name' => 'Barley',
                'description' => 'Barley',
                'product_category_id' => 1,
                'price' => 250,
                'unit' => 'Kg',
                'market_price' => '400',
                
                'bulk_quantity' => 5,
                'bulk_discount' => 4,
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

            ]
            );
    }
}
