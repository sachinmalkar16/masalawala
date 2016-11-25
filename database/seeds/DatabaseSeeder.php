<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    protected $tables = [
        'orders',
        'order_details',
        'password_resets',
        'products',
        'product_category',
        'product_likes',
        'product_photos',
        'product_promo',
        'product_ratings',
        'product_reviews',
        'shopping_cart	',
        'users',
        'user_address',
        'user_notification',
        'wish_list',

    ];

    protected $seeders = [
        'UsersTableSeeder',
        'ProductCategoryTableSeeder',
        'ProductsTableSeeder',
        'ProductLikeTableSeeder',
        'ProductRatingTableSeeder',
        'ProductsReviewTableSeeder',
        'ProductPhotosTableSeeder'


    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        // $this->cleanDatabase();

        foreach ($this->seeders as $seedClass) {

            $this->call($seedClass);
        }


    }

    /**
     * Clean out the database for new seed generation
     */
    public function cleanDatabase()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {

            DB::table($table)->truncate();
        }

        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
