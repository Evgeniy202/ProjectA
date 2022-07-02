<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('support', function () {
    return view('support');
})->middleware('verified')->name('support');

Route::get('profile', function () {
    return view('profile');
})->middleware('verified')->name('profile');


/////////////Admin//////////////////

Route::get('/admin/adm/login', [AdminController::class, 'signIn']);
Route::post('/admin/adm/login/check', [AdminController::class, 'loginCheck']);

Route::get('/admin/adm/mainAdm', [AdminController::class, 'mainAdm'])
    ->name('mainAdm');
Route::get('/admin/adm/category', [AdminController::class, 'categories'])
    ->name('admCategories');
Route::get('/admin/adm/category/{id}/char', [AdminController::class, 'admCategoriesChar'])
    ->name('admCategoriesChar');
Route::get('/admin/adm/category/{id}/char/{charId}/values', [AdminController::class, 'admCharValues'])
    ->name('admCharValues');
Route::get('/admin/adm/products', [AdminController::class, 'products'])
    ->name('admProducts');

Route::post('/admin/adm/category/add_category', [AdminController::class, 'addCategory'])
    ->name('addCategory');
Route::post('/admin/adm/category/change_category/{id}', [AdminController::class, 'changeCategory'])
    ->name('changeCategory');
Route::get('/admin/adm/category/remove_category/{id}', [AdminController::class, 'removeCategory'])
    ->name('removeCategory');

Route::post('/admin/adm/products/add_product', [AdminController::class, 'addProduct'])
    ->name('addProduct');
Route::get('/admin/adm/products/add_product/{categoryId}', [AdminController::class, 'productOfCategory'])
    ->name('productOfCategory');
Route::get('/admin/adm/products/add_char/{productId}', [AdminController::class, 'addCharToProductView'])
    ->name('addCharToProductView');

Route::post('/admin/adm/products/add_char/{productId}/addCharToProduct',
    [AdminController::class, 'addCharToProduct'])
    ->name('addCharToProduct');
Route::post('/admin/adm/products/add_char/{productId}/change/{prodCharId}',
    [AdminController::class, 'changeCharToProduct'])
    ->name('changeCharToProduct');
Route::get('/admin/adm/products/add_char/{productId}/remove/{prodCharId}',
    [AdminController::class, 'removeCharToProduct'])
    ->name('removeCharToProduct');
Route::post('/admin/adm/category/{id}/char/addChar', [AdminController::class, 'addChar'])
    ->name('addChar');
Route::post(
    '/admin/adm/category/{id}/char/addValue/{charId}', [AdminController::class, 'addCharValue'])
    ->name('addCharValue');
Route::post('/admin/adm/category/{id}/char/changeChar/{charId}', [AdminController::class, 'changeChar'])
    ->name('changeChar');
Route::get('/admin/adm/category/{id}/char/removeChar/{charId}', [AdminController::class, 'removeChar'])
    ->name('removeChar');
Route::post('/admin/adm/category/{id}/char/{charId}/values/{valueId}/change', [AdminController::class, 'changeValue'])
    ->name('changeValue');
Route::get('/admin/adm/category/{id}/char/{charId}/values/{valueId}/remove', [AdminController::class, 'removeValue'])
    ->name('removeValue');
Route::post('admin/adm/category/{id}/char/{charId}/values/addNewValue', [AdminController::class, 'addValue'])
    ->name('addValue');

//AJAX
Route::get('/admin/adm/products/add_char/{productId}/{charId}', [AjaxController::class, 'findCharValue'])
    ->name('findCharValue');


//Dev
// Route::get('/admin/reg', [AdminController::class, 'reg']);
// Route::post('/admin/reg/check', [AdminController::class, 'regCheck']);
