<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
  'user_id',
  'cart_id',
  'checkout_id',
  'total_amount',
  'delivery_company_id',
  'shipping_fee',
  'delivery_fee',
  'payment_method',
  'status'
])]
class Order extends Model
{
  protected $casts = [
    'total_amount' => 'double',
    'shipping_fee' => 'double',
    'delivery_fee' => 'double',
  ];
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function cart()
  {
    return $this->belongsTo(Cart::class);
  }

  public function checkout()
  {
    return $this->belongsTo(Checkout::class);
  }

  public function orderItems()
  {
    return $this->hasMany(OrderItem::class);
  }
}
