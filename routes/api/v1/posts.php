<?php

use App\Http\Controllers\PostController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


// Route::apiResource('posts', PostController::class);

Route::prefix('posts')
    // ->middleware([
    //     'auth',
    //     RedirectIfAuthenticated::class,
    // ])
    ->as('posts.')
    //->namespace('\App\Http\Controllers')
    ->group(function () {
        Route::get('/', [PostController::class, 'index'])
            ->name('index');

        Route::get('/{post}', [PostController::class, 'show'])
            ->name('show');

        Route::post('/', [PostController::class, 'store'])
            ->name('store');

        Route::patch('/{post}', [PostController::class, 'update'])
            ->name('update');

        Route::delete('/{post}', [PostController::class, 'destroy'])
            ->name('destroy');
    });
