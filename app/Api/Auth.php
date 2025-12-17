<?php

namespace App\Api;

use App\Interface\AuthService as InterfaceAuthService;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

final class Auth implements InterfaceAuthService
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5'],
        ]);

        if (!$validator->fails()) {
            $token = (new AuthService())->login($request->all());
            if ($token) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login com sucesso',
                    'token' => $token,
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Credenciais inválidas',
                ], 401);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
            ]);

            if (!$validator->fails()) {
                $authApi = new AuthService();
                $authApi->register($request->all());
                $token = $authApi->login($request->all());
                return response()->json([
                    'status' => 'success',
                    'message' => 'Usuário cadastrado com sucesso',
                    'token' => $token,
                ], 201);
            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error_exception' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
        }
    }

    public function logout(Request $request) {
        (new AuthService())->logout($request);
    }
}
