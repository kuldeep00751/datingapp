<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Adding the verification option field
            $table->string('verificationOption')->nullable();

            // Adding the corporate email field
            $table->string('corporate_email_status')->default(0)->nullable();

            // Adding the employment certificate field (this will store the file path)
            $table->string('employmentCertificate')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
            // Drop the columns in case of rollback
            $table->dropColumn('verificationOption');
            $table->dropColumn('corporate_email_status');
            $table->dropColumn('employmentCertificate');

            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
