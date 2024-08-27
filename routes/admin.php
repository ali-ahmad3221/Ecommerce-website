<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    if(!auth()->user()){
        return redirect()->route('admin.login');
    }
    else {
        // $data['categories'] = Category::count();
        // $data['brands'] = Brand::count();
        // $data['products'] = Product::count();
        // $data['lead'] = Lead::count();
        return view('admin.pages.dashboard');
    }
})->name('dashboard.view');

Route::controller(App\Http\Controllers\Admin\AdminController::class)->group(function () {
    Route::get('dashboard','adminDashboard')->name('admin.dashboard');
    Route::get('profile','Profile')->name('admin.profile');
    Route::get('login','login')->name('admin.login');
    Route::post('login','loginAdmin')->name('admin.login.submit');
    Route::get('register','register')->name('admin.register');
    Route::post('admn-register','adminRegister')->name('admin.register.submit');
    Route::get('logout','logout')->name('admin.logout');
    Route::get('profile','profile')->name('admin.profile');
});

Route::prefix('customers')->controller(App\Http\Controllers\Admin\CustomerController::class)->group(function () {
    Route::get('list', 'ourCustomers')->name('our.customers');
    Route::get('status', 'customerStatus')->name('customer.status');
});

Route::prefix('orders')->controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
    Route::get('list', 'ordersList')->name('orders.index');
    Route::get('status', 'orderStatus')->name('change.status');
    Route::get('order-details/{id}', 'getOrderDetails')->name('get.order.details');

});
Route::resource('product', App\Http\Controllers\Admin\ProductController::class)->middleware('auth');
