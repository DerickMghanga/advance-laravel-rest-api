<?php

use App\Http\Controllers\CommentController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


// Route::apiResource('comments', CommentController::class);

Route::prefix('comments')
    // ->middleware([
    //     'auth',
    //     RedirectIfAuthenticated::class,
    // ])
    ->as('comments.')
    //->namespace('\App\Http\Controllers')
    ->group(function () {
        Route::get('/', [CommentController::class, 'index'])
            ->name('index');

        Route::get('/{comment}', [CommentController::class, 'show'])
            ->name('show');

        Route::post('/', [CommentController::class, 'store'])
            ->name('store');

        Route::patch('/{comment}', [CommentController::class, 'update'])
            ->name('update');

        Route::delete('/{comment}', [CommentController::class, 'destroy'])
            ->name('destroy');
    });
