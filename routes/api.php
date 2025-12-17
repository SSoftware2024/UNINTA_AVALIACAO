<?php

use App\Api\Auth as AuthApi;
use App\Api\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/user', function (Request $request) {
    ds('here');
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', function (Request $request) {
    try {
        $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:5', 'confirmed'],
    ]);

    if (!$validator->fails()) {
        $authApi = new AuthApi();
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
});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('task_list')->group(function () {
        Route::post('/', [TaskList::class, 'create']);
        Route::get('/', [TaskList::class, 'read']);
        Route::patch('/{id}', [TaskList::class, 'update']);
        Route::delete('/{id}', [TaskList::class, 'delete']);
    });



});
