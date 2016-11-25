<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('product_name')->unique();
            $table->string('indian_name')->nullable();;
            $table->text('description');
            $table->integer('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_category')->onDelete('cascade');
            $table->decimal('price');
            $table->string('unit');
            $table->decimal('market_price')->nullable();
            $table->decimal('bulk_quantity')->nullable();
            $table->decimal('bulk_discount')->nullable();
            $table->boolean('roasted')->default(0);
            $table->boolean('grinded')->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
