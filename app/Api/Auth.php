<?php
namespace App\Api;

use App\Models\User;

final class Auth
{
    public function register(array $data): array
    {
        User::create($data);
        return [
            'status' => 'success',
            'message' => 'User registered successfully',
        ];
    }
}
