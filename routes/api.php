<?php

use App\Api\Auth as AuthApi;
use App\Api\ListItem;
use App\Api\TaskList;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;



Route::post('/login', [AuthApi::class,'login']);
Route::post('/register', [AuthApi::class,'register']);
Route::post('/logout', [AuthApi::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('task_list')->group(function () {
        Route::post('/', [TaskList::class, 'create']);
        Route::get('/', [TaskList::class, 'read']);
        Route::patch('/{id}', [TaskList::class, 'update']);
        Route::delete('/{id}', [TaskList::class, 'delete']);
    });
    Route::prefix('list_item')->group(function () {
        Route::post('/', [ListItem::class, 'create']);
        Route::get('/', [ListItem::class, 'read']);
        Route::patch('/{id}', [ListItem::class, 'update']);
        Route::patch('/changeStatus/{id}', [ListItem::class, 'changeStatus']);
        Route::delete('/{id}', [ListItem::class, 'delete']);
    });
});
