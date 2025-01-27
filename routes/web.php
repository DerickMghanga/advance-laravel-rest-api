<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// allow to test on local
if (\Illuminate\Support\Facades\App::environment('local')) {

    Route::get('/playground', function () {
        $user = \App\Models\User::factory()->make();  // create a fake user

        \Illuminate\Support\Facades\Mail::to($user)->send(new \App\Mail\WelcomeMail($user));

        return null;
    });
}
