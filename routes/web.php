<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;

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


//Login Routes

Route::any('/login',[LoginController::class,'index'])->name('login');
Route::any('/dologin',[LoginController::class,'DoLogin'])->name('dologin');

// Public User Routes
Route::middleware(['auth'])->group(function(){
Route::any('/home',[LoginController::class,'Home'])->name('home');
//logout only user is authenticated
Route::any('/logout',[LoginController::class,'DoLogout'])->name('logout');
});

//Admin Access Routes
Route::group(['middleware' => ['auth', 'admin']], function () {
Route::get('/', function () {return view('dashboard');})->name('dashboard');
Route::get('product/create-product',[ProductController::class,'CreateProduct'])->name('product.create-product');
Route::post('product/store',[ProductController::class,'StoreProduct'])->name('product.store');
Route::get('product/list',[ProductController::class,'ProductList'])->name('product.list');
Route::get('product/listing',[ProductController::class,'ProductListing'])->name('product.listing');
Route::get('product/delete/{product_id}',[ProductController::class,'Delete'])->name('product.delete');
Route::get('product/details/{id}',[ProductController::class,'GetProduct'])->name('product.details');
Route::post('product/update',[ProductController::class,'UpdateProduct'])->name('product.update');
});