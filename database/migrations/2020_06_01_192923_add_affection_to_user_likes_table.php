<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAffectionToUserLikesTable extends Migration
{

    public function up(): void
    {
        Schema::table('user_likes', function (Blueprint $table) {
            $table->string('affection')
                ->nullable()
                ->after('liked_user_id');
        });
    }

    public function down(): void
    {
        Schema::table('user_likes', function (Blueprint $table) {
            $table->dropColumn('affection');
        });
    }
}
