<?php

use App\Http\Controllers\Admin_controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Products_controller;
use App\Http\Controllers\Users_controller;
use Illuminate\Support\Facades\Route;



    Route::get('/', [Products_controller::class,'home'])->name('index');
    Route::get('/shop', [Products_controller::class,'shop'])->name('shop');
    Route::get('/home', [Products_controller::class,'home'])->name('home');
    Route::get('/login', [AuthController::class,'showlogin'])->name('showlogin');
    Route::get('/register', [AuthController::class,'showregister'])->name('showregister');
    Route::post('/login', [AuthController::class,'login'])->name('login');
    Route::post('/register', [AuthController::class,'register'])->name('register');
    Route::get('/products/{id}', [Products_controller::class,'show'])->name('product.show');
    Route::get('/products/add_to_cart/{id}', [Products_controller::class,'addToCart'])->name('add_to_cart');
    Route::get('/products/remove_from_cart/{id}', [Products_controller::class,'removeFromCart'])->name('remove_from_cart');
    Route::get('/cart', [Products_controller::class,'cart'])->name('cart');
    Route::get('/shop/categories/{id}', [Products_controller::class,'category'])->name('shop.category');



//admin routes
Route::middleware('auth')->group(function(){
    //Route::get('/admin/login', [Users_controller::class,'admin_login'])->name('admin.login');
    //Route::get('/cart', [Products_controller::class,'cart'])->name('cart');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/profile', [Users_controller::class,'profile'])->name('profile');


});
Route::middleware('admin')->group(function(){
    //Route::get('/admin/login', [Users_controller::class,'admin_login'])->name('admin.login');
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/products', [AdminController::class,'products'])->name('admin.products');
    Route::post('/admin/products/add', [AdminController::class,'addProduct'])->name('admin.addproduct');
    Route::get('/admin/products/add', [AdminController::class,'addProductshow'])->name('admin.addproduct');
    Route::get('admin/products/edit/{id}', [AdminController::class,'editProduct'])->name('admin.editproduct');
    Route::post('admin/products/update/{id}', [AdminController::class,'updateProduct'])->name('admin.updateproduct');
    Route::delete('/admin/delete/{id}', [AdminController::class,'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/admin/categories', [AdminController::class,'showCategories'])->name('admin.categories');
    Route::post('/admin/categories/add', [AdminController::class,'addCategory'])->name('admin.addcategory');
    Route::delete('/admin/categories/delete/{id}', [AdminController::class,'deleteCategory'])->name('admin.deletecategory');
    //update category
    Route::get('/admin/categories/edit/{id}', [AdminController::class,'editCategory'])->name('admin.editcategory');
    Route::post('/admin/categories/update/{id}', [AdminController::class,'updateCategory'])->name('admin.updatecategory');

});


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

