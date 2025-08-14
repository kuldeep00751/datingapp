<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // try {
            $googleUser = Socialite::driver('google')->user();
            
            $accessToken = $googleUser->token;

            // Fetch DOB from Google People API
                // $response = Http::withToken($accessToken)->get('https://people.googleapis.com/v1/people/me', [
                //     'personFields' => 'birthdays'
                // ]);
                // $data = $response->json();
                // $dob = null;

                // if (!empty($data['birthdays'])) {
                //     $birthday = $data['birthdays'][0]['date'];
                //     $dob = isset($birthday['year']) 
                //         ? "{$birthday['year']}-{$birthday['month']}-{$birthday['day']}"
                //         : "{$birthday['month']}-{$birthday['day']}"; // Some users may not have a birth year
                // }

                // dd($data);
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName);
            
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $nameParts[0],
                    'last_name'=>isset($nameParts[1]) ? $nameParts[1] : '',
                    'google_id' => $googleUser->getId(),
                    // 'avatar' => $googleUser->getAvatar(),
                    // 'birthday' => $dob,
                    'password' => bcrypt('default_password'), 
                ]
            );

            Auth::login($user);

            return redirect('/home');
        // } catch (\Exception $e) {
        //     return redirect('/login')->with('error', 'Unable to login with Google.');
        // }
    }
}
