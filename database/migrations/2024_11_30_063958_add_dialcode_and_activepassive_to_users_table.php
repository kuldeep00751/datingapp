<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDialcodeAndActivepassiveToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dialCode', 10)->nullable()->after('phone'); // Add dialCode column
            $table->boolean('activePassive')->nullable()->after('dialCode'); // Add activePassive column
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
            $table->dropColumn(['dialCode', 'activePassive']); // Remove columns
        });
    }
}

