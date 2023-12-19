<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});









// Display form for adding a new product
Route::get('/product/create', [ProductController::class, 'createForm'])->name('product.create');

// Store a new product
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

// Sell a product (update quantity)
//Route::post('/product/sell/{id}', [ProductController::class, 'sell']);
Route::get('/product/sell/{id}', [ProductController::class, 'sellForm'])->name('product.sell');
Route::post('/product/sell/{id}', [ProductController::class, 'sell'])->name('product.sell.submit');

// Change product price
//Route::get('/product/price/{id}/{price}', [ProductController::class, 'changePrice']);
Route::get('/product/change-price/{id}', [ProductController::class, 'changePriceForm'])->name('product.change-price');
Route::post('/product/change-price/{id}', [ProductController::class, 'changePrice'])->name('product.change-price.submit');

// Display dashboard
Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');

// Display sale transaction history
Route::get('/transactions', [ProductController::class, 'transactions'])->name('transactions');


Route::get('/sales-history', [ProductController::class, 'salesHistory'])->name('sales-history');




