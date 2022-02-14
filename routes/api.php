<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Enums\ProductStatus;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


#model binding with routeKeyname
Route::get('/products/{product:name}', [ProductController::class, 'show'])->name('products.show');
# search
Route::get('/products/search/{name}', [ProductController::class, 'search'])->name('products.search');


/// Register / login route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/users', [UserController::class, 'index']);


### single middleware 1
//Route::middleware('auth:sanctum')->get('/products/search/{name}', [ProductController::class, 'search']);

### single middleware 2
//Route::get('/products/search/{name}', [ProductController::class, 'search'])->middleware('auth:sanctum');

### Group Middleware
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/logout', [AuthController::class, 'logout']);
});

//Route::group(['middleware' => ['auth'], 'prefix' => 'admin'])

## works for php 8.1
Route::get('status/{productstatus}', function(ProductStatus $productstatus) {
    return $productstatus->value;
});