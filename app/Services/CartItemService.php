<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class CartItemService
{
  private function getActiveCart()
  {
    if (!Auth::check()) {
      throw new \Illuminate\Auth\AuthenticationException('You must be logged in to add items to the cart.');
    }

    return Cart::firstOrCreate(['user_id' => Auth::id(), 'status' => 'active']);
  }

  public function getCartItems(): Collection
  {
    $cart = $this->getActiveCart();
    return CartItem::where('cart_id', $cart->id)
      ->with(['productVariant.product', 'productVariant.size'])
      ->get();
  }

  public function addToCart(array $data): CartItem
  {
    $cart = $this->getActiveCart();
    $variant = ProductVariant::findOrFail($data['product_variant_id']);

    if ($variant->stock_quantity < $data['quantity']) {
      throw ValidationException::withMessages(['quantity' => ['Quantity is out of stock.']]);
    }

    $cartItem = CartItem::where('cart_id', $cart->id)
      ->where('product_variant_id', $variant->id)
      ->first();

    if ($cartItem) {
      $newQuantity = $cartItem->quantity + $data['quantity'];
      if ($variant->stock_quantity < $newQuantity) {
        throw ValidationException::withMessages(['quantity' => ['Quantity is out of stock.']]);
      }
      $cartItem->increment('quantity', $data['quantity']);
    } else {
      $cartItem = CartItem::create([
        'cart_id' => $cart->id,
        'product_variant_id' => $variant->id,
        'quantity' => $data['quantity'],
      ]);
    }

    return $cartItem->load(['productVariant.product', 'productVariant.size']);
  }

  public function updateQuantity(int $id, int $quantity): CartItem
  {
    $cart = $this->getActiveCart();

    $cartItem = CartItem::where('cart_id', $cart->id)->findOrFail($id);

    $variant = ProductVariant::findOrFail($cartItem->product_variant_id);
    if ($variant->stock_quantity < $quantity) {
      throw ValidationException::withMessages(['quantity' => ['Quantity is out of stock']]);
    }

    $cartItem->update(['quantity' => $quantity]);

    return $cartItem->load(['productVariant.product', 'productVariant.size']);
  }

  public function removeItem(int $id): bool
  {
    $cart = $this->getActiveCart();

    return (bool) CartItem::where('cart_id', $cart->id)->where('id', $id)->delete();
  }

  public function clearCart(): void
  {
    $cart = $this->getActiveCart();
    CartItem::where('cart_id', $cart->id)->delete();
  }
}
