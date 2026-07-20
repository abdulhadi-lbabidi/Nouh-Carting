<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PermissionController;
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

  // Auth
  Route::post('register', [AuthController::class, 'register']);
  Route::post('login', [AuthController::class, 'login']);

  // Categories
  Route::get('categories', [CategoryController::class, 'index']);
  Route::get('categories/{category}', [CategoryController::class, 'show']);

  // Products
  Route::get('products', [ProductController::class, 'index']);
  Route::get('products/featured', [ProductController::class, 'featured']);
  Route::get('products/{product}', [ProductController::class, 'show']);
  Route::get('products-sliders', [ProductController::class, 'sliders']);

  // Product Variants
  Route::get('product-variants', [ProductVariantController::class, 'index']);
  Route::get('product-variants/{product_variant}', [ProductVariantController::class, 'show']);

  // Product Variant Packages
  Route::get('packages', [PackageController::class, 'index']);
  Route::get('packages/{package}', [PackageController::class, 'show']);

  // Reviews
  Route::get('reviews', [ReviewController::class, 'index']);
  Route::get('reviews/{review}', [ReviewController::class, 'show']);

  // Attributes
  Route::get('sizes', [SizeController::class, 'index']);
  Route::get('materials', [MaterialController::class, 'index']);
});


/*
|--------------------------------------------------------------------------
| Authenticated User API
|--------------------------------------------------------------------------
*/
Route::middleware(['setLocale', 'auth:sanctum'])->group(function () {
  // User
  Route::get('me', [AuthController::class, 'me']);
  Route::put('profile', [AuthController::class, 'updateProfile']);

  // Wishlist
  Route::get('wishlist', [WishlistController::class, 'index']);
  Route::post('wishlist', [WishlistController::class, 'store']);
  Route::delete('wishlist/{wishlist}', [WishlistController::class, 'destroy']);

  // Reviews
  Route::post('reviews', [ReviewController::class, 'store']);
  Route::put('reviews/{review}', [ReviewController::class, 'update']);
  Route::delete('reviews/{review}', [ReviewController::class, 'destroy']);

  // Cart
  Route::get('/cart', [CartController::class, 'index']);
  Route::post('/cart', [CartController::class, 'store']);
  Route::put('/cart/{id}', [CartController::class, 'update']);
  Route::delete('/cart/{id}', [CartController::class, 'destroy']);
  Route::delete('/cart-clear', [CartController::class, 'clear']);


  // Checkout & Orders
  Route::apiResource('checkouts', CheckoutController::class);

  Route::apiResource('orders', OrderController::class);
});


/*
|--------------------------------------------------------------------------
| Admin API (AUTH + ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['setLocale', 'auth:sanctum'])->group(function () {

  Route::get('/dashboard/statistics', [DashboardController::class, 'index']);

  Route::get('permissions', [PermissionController::class, 'index']);


  // Roles
  Route::apiResource('roles', RoleController::class);

  // Users
  Route::apiResource('users', UserController::class);

  // Categories
  Route::apiResource('categories', CategoryController::class)
    ->except(['index', 'show']);

  // Products
  Route::apiResource('products', ProductController::class)
    ->except(['index', 'show']);

  // update Product Variants
  Route::put('product-variants/bulk-update', [ProductVariantController::class, 'update']);
  Route::apiResource('product-variants', ProductVariantController::class)
    ->except(['index', 'show', 'update']);

  // Product Variant Packages
  Route::apiResource('packages', PackageController::class)
    ->except(['index', 'show']);

  // Sizes
  Route::apiResource('sizes', SizeController::class)
    ->except(['index']);

  // Materials
  Route::apiResource('materials', MaterialController::class)
    ->except(['index']);
});