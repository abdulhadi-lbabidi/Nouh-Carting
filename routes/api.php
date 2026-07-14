<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SizeController;
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

  // Attributes
  Route::get('sizes', [SizeController::class, 'index']);
  Route::get('materials', [MaterialController::class, 'index']);
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
Route::middleware(['setLocale'])->group(function () {


  Route::apiResource('categories', CategoryController::class)
    ->except(['index', 'show']);

  Route::apiResource('products', ProductController::class)
    ->except(['index', 'show']);

  Route::apiResource('sizes', SizeController::class)
    ->except(['index']);

  Route::apiResource('materials', MaterialController::class)
    ->except(['index']);
});
