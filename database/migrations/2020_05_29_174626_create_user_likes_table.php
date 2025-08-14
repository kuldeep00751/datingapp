<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLikesTable extends Migration
{
    public function up()
    {
        Schema::create('user_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('liked_user_id')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'liked_user_id']);
//            $table->primary(['user_id', 'liked_user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_likes');
    }
}
