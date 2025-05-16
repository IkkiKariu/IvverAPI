<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\PersonalAccessToken;

class AuthService
{
    public function auth(array $credentials): ?string
    {
        $user = User::where('login', $credentials['login'])->first();
        if (!Hash::check($credentials['password'], $user->password)) { return null; }

        $token = $user->createToken('auth-token')->plainTextToken;
        
        return explode('|', $token)[1];
    }

    public function forgetToken(string $token)
    {
        PersonalAccessToken::where('token', hash('sha256', $token))->first()->delete();
    }
}