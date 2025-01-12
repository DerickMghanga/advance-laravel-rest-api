<?php

use App\Helpers\Routes\RouteHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    RouteHelper::includeStaticFiles(__DIR__ . '/api/v1'); // this function iterates through a given folder with route files

    // require __DIR__ . '/api/v1/users.php'; // adds all users routes from a file
    // require __DIR__ . '/api/v1/posts.php';
    // require __DIR__ . '/api/v1/comments.php';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
