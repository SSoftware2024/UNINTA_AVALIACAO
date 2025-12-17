<?php

namespace App\Api;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class Auth
{
    public function register(array $data): void
    {
        $data['password'] = Hash::make($data['password']);
        User::create($data);
    }

    public function login(array $data): ?string
    {
        $user = User::where('email', $data['email'])->first();
        $token = '';

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('api_token');
            $token = $token->plainTextToken;
        }
        return  $token ?? null;
    }

    public function logout(Request $request): void
    {
        $request->user()->tokens()->delete();
    }
}
