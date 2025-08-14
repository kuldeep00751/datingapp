<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRadiusAndIpAddressToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('radius')->nullable();  // Add radius field
            $table->string('ip_address')->nullable();  // Add ip_address field
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['radius', 'ip_address']);  // Drop the columns if rolled back
        });
    }
}
