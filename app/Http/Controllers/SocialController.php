<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrNew([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
        ]);
        $user->google_id = $googleUser->getId();
        $user->email_verified_at = now();
        $user->save();


        Auth::login($user);

        return redirect('/dashboard');
    }
}
