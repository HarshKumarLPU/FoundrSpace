<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('status', 'Authentication failed. Please try again.');
        }

        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Update the user's provider info if they previously signed up with email
            if (!$user->provider_id) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }
            Auth::login($user);
        } else {
            // Create a new user
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'role' => 'customer', // Default role for social logins
                'password' => null, // Password is null for social logins
                'email_verified_at' => now(), // Assume email is verified by provider
            ]);

            Auth::login($user);
        }

        return redirect()->route('dashboard');
    }
}
