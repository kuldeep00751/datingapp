<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->string('cover_picture')->nullable();
            $table->string('sex')->nullable();
            $table->string('birthday')->nullable();
            $table->string('interested_in')->nullable();
            $table->text('description')->nullable();
            $table->string('interested_min_age_range')->nullable();
            $table->string('interested_max_age_range')->nullable();
            $table->integer('age')->nullable();
            $table->string('like_to_be_called')->nullable();
            $table->string('height')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('other_nationality')->nullable();
            $table->string('other_nationality_country')->nullable();
            $table->string('academic_level')->nullable();
            $table->string('children')->nullable();
            $table->string('children_have_many')->nullable();
            $table->string('children_age')->nullable();
            $table->string('children_ifnot_region')->nullable();
            $table->string('industry_you_work')->nullable();
            $table->text('about_your_job')->nullable();
            $table->string('travel_frecuency')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('music_genres')->nullable();
            $table->string('alcohol')->nullable();
            $table->string('smoke')->nullable();
            $table->string('work_out')->nullable();
            $table->text('what_relaxes_you')->nullable();
            $table->text('find_internally_attractive')->nullable();
            $table->text('social_cause')->nullable();
            $table->text('follow_any_religion')->nullable();
            $table->string('languages')->nullable();
            $table->string('form_which_countries')->nullable();
            $table->text('life_in_general')->nullable();
            $table->text('what_qualities')->nullable();
            $table->text('nivel_profesional')->nullable();
            $table->text('conversational_style')->nullable();
            $table->text('describe_your_lifestyle')->nullable();
            $table->text('you_laugh')->nullable();
            $table->string('job_related_video')->nullable();
            $table->string('avatar')->nullable();
            $table->string('status')->default(''); // 'pending', 'approved', 'rejected'
            $table->string('married_status')->default();
            $table->string('working_status')->default();
            $table->timestamp('last_email_sent_at')->nullable();
            $table->string('messenger_color')->default('#00BCD4');
            $table->boolean('dark_mode')->default(0);
            $table->boolean('is_hidden')->default(false);
            $table->json('match_user_id')->nullable();
            $table->integer('is_subscribed')->default(0);
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
