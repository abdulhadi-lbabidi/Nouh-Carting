<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
  'order_id',
  'product_variant_id',
  'quantity',
  'price',
  'total'
])]
class OrderItem extends Model
{

  protected $casts = [
    'price' => 'double',
    'total' => 'double'
  ];

  public function order()
  {
    return $this->belongsTo(Order::class);
  }
  public function productVariant()
  {
    return $this->belongsTo(ProductVariant::class, 'product_variant_id');
  }
}