<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', function (Request $request) {
    $validator = Validator::make($request->all(),[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:5', 'confirmed'],
    ]);
    if (!$validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Usuário cadastrado com sucesso',
            'errors' => $validator->errors(),
        ], 201);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }
});
