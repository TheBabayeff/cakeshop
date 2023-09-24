<?php

use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/' , [HomeController::class, 'index'])->name('welcome');

Route::get('/search' , [\App\Http\Controllers\Api\ProductController::class, 'search'])->name('search');

Route::get('/categories' , [\App\Http\Controllers\Api\CategoryController::class, 'index'])->name('categoryIndex');
Route::get('/categories/{id}' , [\App\Http\Controllers\Api\CategoryController::class, 'show'])->name('categoryShow');


Route::get('/products' , [\App\Http\Controllers\Api\ProductController::class, 'index'])->name('productIndex');
Route::get('/products/{id}' , [\App\Http\Controllers\Api\ProductController::class, 'show'])->name('productShow');
