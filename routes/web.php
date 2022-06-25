<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes(['verify'=>true]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about', function() {
    return view('about');
})->name('about');

Route::get('support', function() {
    return view('support');
})->middleware('verified')->name('support');

Route::get('profile', function() {
    return view('profile');
})->middleware('verified')->name('profile');


/////////////Admin//////////////////

Route::get('/admin/adm/login', [AdminController::class, 'signIn']);
Route::post('/admin/adm/login/check', [AdminController::class, 'loginCheck']);

Route::get('/admin/adm/mainAdm', [AdminController::class, 'mainAdm'])->name('mainAdm');
Route::get('/admin/adm/category', [AdminController::class, 'categories'])->name('admCategories');
Route::get('/admin/adm/products', [AdminController::class, 'products'])->name('admProducts');

Route::post('/admin/adm/category/add_category', [AdminController::class, 'addCategory'])->name('addCategory');
Route::post('/admin/adm/category/change_category/{id}', [AdminController::class, 'changeCategory'])->name('changeCategory');
Route::get('/admin/adm/category/remove_category/{id}', [AdminController::class, 'removeCategory'])->name('removeCategory');

Route::post('/admin/adm/products/add_product', [AdminController::class, 'addProduct'])->name('addProduct');


//Dev
// Route::get('/admin/reg', [AdminController::class, 'reg']);
// Route::post('/admin/reg/check', [AdminController::class, 'regCheck']);