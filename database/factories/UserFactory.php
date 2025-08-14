<?php
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = \App\User::class; // Ensure the path to the User model is correct

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'location' => $this->faker->city,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'profile_picture' => null,
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'birthday' => $this->faker->date('Y-m-d', '-18 years'),
            'interested_in' => $this->faker->randomElement(['Male', 'Female', 'Both']),
            'description' => $this->faker->paragraph,
            'interested_min_age_range' => $this->faker->numberBetween(18, 30),
            'interested_max_age_range' => $this->faker->numberBetween(30, 50),
            'age' => $this->faker->numberBetween(18, 80),
            'like_to_be_called' => $this->faker->word,
            'height' => $this->faker->randomFloat(2, 1.5, 2.2), // in meters
            'country_of_birth' => $this->faker->country,
            'other_nationality' => $this->faker->boolean,
            'other_nationality_country' => $this->faker->country,
            'academic_level' => $this->faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
            'children' => $this->faker->boolean,
            'children_have_many' => $this->faker->numberBetween(0, 5),
            'children_age' => $this->faker->words(2, true),
            'children_ifnot_region' => $this->faker->word,
            'industry_you_work' => $this->faker->company,
            'about_your_job' => $this->faker->sentence,
            'travel_frecuency' => $this->faker->randomElement(['Never', 'Sometimes', 'Often']),
            'google_id' => $this->faker->uuid,
            'music_genres' => $this->faker->words(3, true),
            'alcohol' => $this->faker->randomElement(['Yes', 'No', 'Sometimes']),
            'smoke' => $this->faker->randomElement(['Yes', 'No', 'Sometimes']),
            'work_out' => $this->faker->randomElement(['Daily', 'Weekly', 'Never']),
            'what_relaxes_you' => $this->faker->sentence,
            'find_internally_attractive' => $this->faker->sentence,
            'social_cause' => $this->faker->sentence,
            'follow_any_religion' => $this->faker->randomElement(['Yes', 'No']),
            'languages' => $this->faker->words(3, true),
            'form_which_countries' => $this->faker->words(2, true),
            'life_in_general' => $this->faker->sentence,
            'what_qualities' => $this->faker->sentence,
            'nivel_profesional' => $this->faker->randomElement(['Entry', 'Mid', 'Senior']),
            'conversational_style' => $this->faker->randomElement(['Formal', 'Informal']),
            'describe_your_lifestyle' => $this->faker->sentence,
            'you_laugh' => $this->faker->sentence,
            'job_related_video' => $this->faker->url,
            'avatar' => null,
            'phone' => $this->faker->phoneNumber,
            'company_id' => $this->faker->randomNumber(3),
            'company_country' => $this->faker->country,
            'verificationOption' => $this->faker->randomElement(['Email', 'Phone']),
            'corporate_email_status' => $this->faker->randomElement(['Verified', 'Unverified']),
            'employmentCertificate' => null,
            'older_than_18' => true,
            'dialCode' => $this->faker->numerify('+###'),
            'activePassive' => $this->faker->randomElement(['Active', 'Passive']),
            'radius' => $this->faker->numberBetween(1, 100),
            'ip_address' => $this->faker->ipv4,
            'other_languages' => $this->faker->words(3, true),
            'pets' => $this->faker->randomElement(['None', 'Dog', 'Cat', 'Fish']),
            'preferences' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
