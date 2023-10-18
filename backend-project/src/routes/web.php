<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
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

//////////////
Route::resource('products', ProductController::class);
///////////////

///////////////
Route::resource('category', CategoryController::class);
///////////////

//////////////////////
Route::resource('CategoryProduct', CategoryProductController::class);
/////////////////////
