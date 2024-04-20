<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function linkedinLogin(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Socialite::driver('linkedin')->redirect()->getTargetUrl());
    }

    public function linkedinCallback(): \Illuminate\Http\Response
    {
        $providerUser = Socialite::driver('linkedin-openid')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $providerUser->getEmail(),
        ], [
            'email_verified_at' => now(),
            'name' => $providerUser->getName(),
        ]);

        Auth::login($user, true);

        return response()->noContent();
    }
}
