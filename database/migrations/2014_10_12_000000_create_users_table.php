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
            $table->increments('id');
            $table->string('username',32)->unique();
            $table->string('name',32);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_key',60)->unique();
            $table->string('avatar')->default('defaultimage.png');
            $table->string('profile_link')->nullable();
            $table->string('nickname')->nullable();
            $table->string('status')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook_page')->nullable();
            $table->string('twitter_page')->nullable();
            $table->string('youtube_page')->nullable();
            $table->string('about')->nullable();
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
        Schema::dropIfExists('users');
    }
}
