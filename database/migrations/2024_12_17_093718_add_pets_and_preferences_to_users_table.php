<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPetsAndPreferencesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('pets')->nullable()->comment('User preference for pets: yes, indifferent, no');
        $table->text('preferences')->nullable()->comment('Additional comments about pets preferences');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['pets', 'preferences']);
    });
    }
}
