<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
Route::get('/product/{id}/show', [App\Http\Controllers\MainController::class, 'showProduct']);
Route::get('/category/{id}/show', [App\Http\Controllers\MainController::class, 'showCategories']);
Route::get('{id}/single-category', [App\Http\Controllers\MainController::class, 'showSingleCategory']);
Route::get('/search', [App\Http\Controllers\MainController::class, 'search']);
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index']);
Route::get('/shop-single', [App\Http\Controllers\ShopController::class, 'buySingle']);
Route::get('/product/sort', [App\Http\Controllers\ShopController::class, 'index'])->name('product.sort');

Route::get('products/index-paging', [App\Http\Controllers\ShopController::class, 'indexPaging']);

Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

 Route::resource('user', 'App\Http\Controllers\UserController')->middleware('auth');
 Route::resource('cart', 'App\Http\Controllers\CartController')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'isAdmin'], function() {
    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::resource('banner', 'App\Http\Controllers\BannerController');
    Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'showUsers']);
    Route::get('/admin/user/create', [App\Http\Controllers\AdminController::class, 'addUser']);
    Route::post('/admin/user/store', [App\Http\Controllers\AdminController::class, 'storeUser']);
    Route::get('/admin/user/{id}/edit', [App\Http\Controllers\AdminController::class, 'editUser']);
    Route::post('/admin/user/{id}/update', [App\Http\Controllers\AdminController::class, 'updateUser']);

});
