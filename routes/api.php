<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');



/*
|--------------------------------------------------------------------------
| Public API (NO AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware(['setLocale'])->group(function () {




  // Categories
  Route::get('categories', [CategoryController::class, 'index']);
  Route::get('categories/{category}', [CategoryController::class, 'show']);

  // Products
  Route::get('products', [ProductController::class, 'index']);
  Route::get('products/featured', [ProductController::class, 'featured']);
  Route::get('products/{product}', [ProductController::class, 'show']);
  Route::get('products-sliders', [ProductController::class, 'sliders']);
});


/*
|--------------------------------------------------------------------------
| Authenticated User API
|--------------------------------------------------------------------------
*/
Route::middleware(['setLocale', 'auth:sanctum'])->group(function () {});





/*
|--------------------------------------------------------------------------
| Admin API (AUTH + ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['setLocale', 'auth:sanctum'])->group(function () {


  Route::apiResource('categories', CategoryController::class)
    ->except(['index', 'show']);

  Route::apiResource('products', ProductController::class)
    ->except(['index', 'show']);
});
