<?php

use App\Http\Controllers\Admin_controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Contact_controller;
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
    //reset password
    Route::get('/password/reset', [AuthController::class,'showResetPassword'])->name('password.request');
    //Route::post('/password/reset', [AuthController::class,'resetPassword'])->name('password.reset');
    Route::post('/password/reset/form', [AuthController::class,'sendResetLink'])->name('password.sendResetLink');
   Route::get('/password/reset/new', [AuthController::class,'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class,'resetPassword'])->name('password.update');

    Route::get('/products/add_to_cart/{id}', [Products_controller::class,'addToCart'])->name('add_to_cart');
    Route::get('/products/remove_from_cart/{id}', [Products_controller::class,'removeFromCart'])->name('remove_from_cart');
    Route::get('/products/clear_cart', [Products_controller::class,'clearCart'])->name('clear_cart');
    Route::get('/products/{id}', [Products_controller::class,'show'])->name('product.show');
    Route::get('/cart', [Products_controller::class,'cart'])->name('cart');
    //view orders
    //Route::get('/orders', [Products_controller::class,'orders'])->name('orders');
    Route::get('/orders/view/{id}', [Products_controller::class,'viewOrder'])->name('user.view_order');
    Route::get('/orders/cancel/{id}', [Products_controller::class,'cancelOrder'])->name('order.cancel');


    Route::get('/shop/categories/{id}', [Products_controller::class,'category'])->name('shop.category');
    Route::post('/contact/submit', [Contact_controller::class,'contactSubmit'])->name('contact.submit');
    Route::get('/search', [Products_controller::class,'search'])->name('search');
    Route::post('/search', [Products_controller::class,'search'])->name('search');
    //store order order.store
    Route::post('/orders/store', [Products_controller::class,'storeOrder'])->name('orders.store');
    //show terms and conditions
    Route::get('/terms', function () {
        return view('terms');
    })->name('terms');
    //show privacy policy
   
    //show faqs
    Route::get('/faqs', function () {
        return view('faqs');
    })->name('faqs');
    




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
    //view users
    Route::get('/admin/users', [AdminController::class,'users'])->name('admin.users');
    Route::get('/admin/users/add', [AdminController::class,'show_addUser'])->name('admin.adduser.show');
    Route::post('/admin/users/add', [AdminController::class,'addUser'])->name('admin.adduser');
    //show add user form
    Route::get('/admin/users/edit/{id}', [AdminController::class,'editUser'])->name('admin.edituser');
    Route::post('/admin/users/update/{id}', [AdminController::class,'updateUser'])->name('admin.updateuser');
    Route::delete('/admin/users/delete/{id}', [AdminController::class,'deleteUser'])->name('admin.deleteuser');
    Route::get('/admin/orders', [AdminController::class,'orders'])->name('admin.orders');
    //view order
    //Route::get('/admin/orders/view', [AdminController::class,'viewOrder'])->name('admin.viewOrder');
    Route::get('/admin/orders/view/{id}', [AdminController::class,'viewOrder'])->name('admin.viewOrder');
    //pending orders
    Route::get('/admin/orders/pending', [AdminController::class,'pendingOrders'])->name('admin.pendingorders');
    //completed orders
    Route::get('/admin/orders/completed', [AdminController::class,'completedOrders'])->name('admin.completedorders');
    //cancelled orders
    Route::get('/admin/orders/cancelled', [AdminController::class,'cancelledOrders'])->name('admin.cancelledorders');
    //shipped orders
    Route::get('/admin/orders/shipped', [AdminController::class,'shippedOrders'])->name('admin.shippedorders');
    Route::post('/admin/orders/updateStatus', [AdminController::class,'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::post('/admin/orders/updateStatus/return', [AdminController::class,'updateOrderStatus_return'])->name('admin.orders.updateStatus.return');
    Route::get('/admin/orders/delete/{id}', [AdminController::class,'deleteOrder'])->name('admin.deleteorder');
    //view contact messages
    Route::get('/admin/contact', [AdminController::class,'contact'])->name('admin.contact');
    Route::get('/admin/contact/view/{id}', [AdminController::class,'viewContact'])->name('admin.viewcontact');


});


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

