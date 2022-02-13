<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Enums\ProductStatus;

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

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
#model binding with routeKeyname
Route::get('/products/{product:name}', [ProductController::class, 'show'])->name('products.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
# search
Route::get('/products/search/{name}', [ProductController::class, 'search'])->name('products.search');

## works for php 8.1
Route::get('status/{productstatus}', function(ProductStatus $productstatus) {
    return $productstatus->value;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
