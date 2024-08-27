<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\HomeController;
use App\Http\Controllers\website\AuthController;
use App\Http\Controllers\website\StripePaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.page');
Route::get('cart', [HomeController::class, 'cart'])->name('cart.page');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout.page');
Route::get('shop', [HomeController::class, 'Shop'])->name('shop.page');
Route::get('blog', [HomeController::class, 'blog'])->name('blog.page');
Route::get('contectus', [HomeController::class, 'contectUs'])->name('contect.us.page');

// Auth Routes
Route::get('login', [AuthController::class, 'login'])->name('login.page');
Route::post('login-user', [AuthController::class, 'loginUser'])->name('login.user');
Route::get('register', [AuthController::class, 'register']);
Route::Post('register', [AuthController::class, 'registration'])->name('register.page');
Route::get('logout', [AuthController::class, 'logOut'])->name('logout.page');

//login with google using laravel socialite
Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleCallback']);

Route::get('send-mail', [AuthController::class, 'testingMail'])->name('send.email');

Route::get('profile', [AuthController::class, 'getProfile'])->name('get.profile');
Route::post('update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');

Route::resource('product', ProductController::class);

Route::post('cart', [CartController::class, 'addcart'])->name('add.to.cart');
Route::get('cart-list', [CartController::class, 'cartList'])->name('cart.list');
Route::get('trash-cart-item', [CartController::class, 'trashCartItem'])->name('trash.cart.item');
Route::post('update-cart-item', [CartController::class, 'updateCartItem'])->name('update.cart.item');

Route::post('proceed-to-payment', [CartController::class, 'proceedToPayment'])->name('proceed.to.payment');
Route::get('my-orders', [CartController::class, 'myOrders'])->name('my.orders');


Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe.page');
    Route::post('stripe', 'stripePost')->name('add.subscriptions');
});
