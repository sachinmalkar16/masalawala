<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('username',50);
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('email')->unique();
            $table->boolean('email_verification')->default(0);
            $table->string('mobile')->nullable();
            $table->boolean('mobile_verification')->default(0);
            $table->char('gender', 1)->nullable();
            $table->date('birthday')->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('online_status')->default(0);
            $table->string('provider_id',50)->nullable();
            $table->string('provider',20)->nullable();
            //if user is blocked from chating it will be set to 0
            $table->boolean('chat_status')->default(1);
            //if user is paid user or not
            $table->boolean('premium')->default(0);
            $table->boolean('system_verified')->default(0);
            $table->string('password');
            $table->boolean('role')->default(0);
            $table->integer('otp')->nullable();
            $table->boolean('active')->default(1);
            //$table->char('api_token', 60)->unique();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
