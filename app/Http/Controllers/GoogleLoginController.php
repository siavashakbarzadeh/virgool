<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function send()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirect()
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();
            if (! $user = User::where('email', $socialiteUser->email)->first()) {
                return redirect('login');
            }
            auth()->login($user, true);
            return redirect('/');
        } catch (\Exception $exception) {
            return redirect('login');
        }
    }
}
