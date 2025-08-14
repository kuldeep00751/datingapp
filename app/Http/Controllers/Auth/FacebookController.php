<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Check if the user already exists in your database
            $user = User::where('email', $facebookUser->getEmail())->first();

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => bcrypt('default_password'),
                ]);
            }

            // Log in the user
            Auth::login($user);

            return redirect()->intended('/home'); 
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Unable to login using Facebook.']);
        }
    }
}
