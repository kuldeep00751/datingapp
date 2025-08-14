<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';
    protected $guard = 'admin';

    protected $fillable = ['name',
        'last_name',
        'location',
        'email',
        'password',
        'profile_picture',
        'cover_picture',
        'sex',
        'birthday',
        'interested_in',
        'interested_preference',
        'description',
        'interested_min_age_range',
        'interested_max_age_range',
        'height_preference',
        'working_status',
        'age',
        'like_to_be_called',
        'height',
        'feet',
        'inches',
        'country_of_birth',
        'other_nationality',
        'other_nationality_country',
        'academic_level',
        'children',
        'children_have_many',
        'children_age',
        'children_ifnot_region',
        'industry_you_work',
        'about_your_job',
        'travel_frecuency',
        'google_id',
        'facebook_id',
        'music_genres',
        'alcohol',
        'smoke',
        'comment_smoke',
        'work_out',
        'comment_workout',
        'what_relaxes_you',
        'find_internally_attractive',
        'social_cause',
        'follow_any_religion',
        'languages',
        'form_which_countries',
        'life_in_general',
        'what_qualities',
        'nivel_profesional',
        'conversational_style',
        'describe_your_lifestyle',
        'you_laugh',
        'job_related_video',
        'avatar',
        'phone',
        'company_id',
        'company_country',
        'verificationOption', 
        'corporate_email_status', 
        'corporate_email',
        'employmentCertificate',
        'older_than_18',
        'dialCode',
        'activePassive',
        'radius',
        'ip_address',
        'other_languages',
        'pets',
        'preferences',
        'status',
        'city',
        'country',
    ];
}

