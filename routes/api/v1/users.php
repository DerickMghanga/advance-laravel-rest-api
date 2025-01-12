<?php

use App\Http\Controllers\UserController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


// Route::apiResource('users', UserController::class);

// Route::group([
//     'prefix' => 'users',
//     'middleware' => 'auth',
//     'as' => 'users.'
// ], function () {
//     Route::get('/', [UserController::class, 'index'])
//         ->name('index');
//     Route::get('/{user}', [UserController::class, 'show'])
//         ->name('show');
//     Route::post('/', [UserController::class, 'store'])
//         ->name('store');
//     Route::patch('/{user}', [UserController::class, 'update'])
//         ->name('update');
//     Route::delete('/{user}', [UserController::class, 'destroy'])
//         ->name('destroy');
// });

Route::prefix('users')
    // ->middleware([
    //     'auth',
    //     RedirectIfAuthenticated::class,
    // ])
    ->as('users.')
    //->namespace('\App\Http\Controllers')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth');

        // Route::get('/', 'UserController@index')
        //     ->name('index');

        Route::get('/{user}', [UserController::class, 'show'])
            ->name('show')
            // ->where('user', '[0-9]+') // add a contraint, ONLY numeric at the URL path
            ->whereNumber('user');  // add a contraint, ONLY numeric at the URL path

        Route::post('/', [UserController::class, 'store'])
            ->name('store');

        Route::patch('/{user}', [UserController::class, 'update'])
            ->name('update');

        Route::delete('/{user}', [UserController::class, 'destroy'])
            ->name('destroy');
    });
