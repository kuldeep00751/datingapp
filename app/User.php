<?php
namespace App;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
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
        'usually_eat',
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
        'latitude',
        'longitude',
        'city',
        'country',
        'res_country',
        'res_state',
        'res_city',
        'last_email_sent_at',
        'exit_at',
        'is_hidden',
        'match_user_id',
        'last_reminder',
        'last_Verify_reminder',
        'last_pay_reminder',
        'is_subscribed',
        'provide_proof',
        'is_single',
        'is_enjoy',
        'is_take_care',
        'is_meet_people',
        'is_understand_platform',
        'is_term_condition',
        'is_lock_location',
        'local',
    ];

    protected $hidden = [
    'password', 'remember_token',
    ];

    protected $casts = [
    'email_verified_at' => 'datetime',
    'match_user_id' => 'array',
    ];


    public function getPicture(): string
    {
        if ($this->profile_picture == null) {
            return env('APP_URL') . '/pictures/default.png';
        }
        return Storage::url($this->profile_picture);
    }

    public function getURL(): string
    {
        $picture = Storage::exists($this->profile_picture);
        if ($picture === false) {
        $picture = $this->profile_picture;
        }
        return $picture;
    }

    public function getAge(): int
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function scopeWithoutMe($query)
    {
        $query->where('id', '<>', auth()->id());
    }

    public function scopeOnlyFemale($query)
    {
        $query->where('sex', '=', 'Female');
    }

    public function scopeOnlyMale($query)
    {
        $query->where('sex', '=', 'Male');
    }

    public function scopeOnlyLGBTIQ($query)
    {
        $query->where('sex', '=', 'LGBTIQ+');
    }

    public function scopeStatusApproved($query)
    {
        $query->where('status', '=', 'approved');
    }

    public function scopeAgeRange($query)
    {
        /**  @var User $user */
        $user = auth()->user();
        if ($user->interested_min_age_range !== null && $user->interested_max_age_range !== null) {
        $minAge = $user->interested_min_age_range;
        $maxAge = $user->interested_max_age_range;
        $minDate = Carbon::today()->subYears($maxAge);
        $maxDate = Carbon::today()->subYears($minAge)->endOfDay();
        $query->whereBetween('birthday', [$minDate, $maxDate]);
        }
    }

    public function scopeWithoutLiked($query)
    {
        /**  @var User $user */
        $user = auth()->user();
        $likedUserIDs = DB::table('user_likes')
        ->leftJoin('users', 'user_likes.user_id', '=', 'users.id')
        ->select('user_likes.liked_user_id')
        ->where('users.id', '=', $user->id)
        ->where('user_likes.affection', '=', 'like')
        ->orderBy('users.created_at', 'desc')
        ->pluck('user_likes.liked_user_id');
        $query->whereNotIn('id', $likedUserIDs);
    }

    public function scopeWithoutDisliked($query)
    {
        /**  @var User $user */
        $user = auth()->user();
        $dislikedUserIDs = DB::table('user_likes')
        ->leftJoin('users', 'user_likes.user_id', '=', 'users.id')
        ->select('user_likes.liked_user_id')
        ->where('users.id', '=', $user->id)
        ->where('user_likes.affection', '=', 'dislike')
        ->orderBy('users.created_at', 'desc')
        ->pluck('user_likes.liked_user_id');
        $query->whereNotIn('id', $dislikedUserIDs);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function affections()
    {
        return $this->hasMany(Affection::class);
    }

    public function affectedBy()
    {
        return $this->hasMany(Affection::class, 'liked_user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\Subscription::class);
    }

    public function scopeInRandomOrder($query)
    {
        return $query->orderByRaw('RAND()'); 
    }

    public function scopeIsHidden($query)
    {
        $query->where('is_hidden', 0);
    }

    public function likeUserData()
    {
        return $this->hasOne(\App\Models\UserLikes::class, 'user_id')->where('affection', 'accept');
    }  
    
}