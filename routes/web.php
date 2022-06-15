<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/signIn', function () {
    return view('signIn');
})->name('signIn');

Route::get('/signUp', function () {
    return view('singUp');
})->name('signUp');

