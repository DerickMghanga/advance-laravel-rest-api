<?php

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function (Request $request) {
    // dump($request);
    return new JsonResponse([
        'data' => 'qqqq'
    ]);
});

Route::get('/users/{user}', function (User $user) {
    return new JsonResponse([
        'data' => $user
    ]);
});

Route::post('/users', function () {
    return new JsonResponse([
        'data' => 'posted'
    ]);
});

Route::patch('/users/{user}', function (User $user) {
    return new JsonResponse([
        'data' => 'patched'
    ]);
});

Route::delete('/users/{user}', function (User $user) {
    return new JsonResponse([
        'data' => 'deleted'
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
