<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->integer('eloquence')->comment('1-5 rating');
            $table->integer('expressiveness')->comment('1-5 rating');
            $table->integer('opinions_ideas')->comment('1-5 rating');
            $table->integer('energy')->comment('1-5 rating');
            $table->integer('willingness')->comment('1-5 rating');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
