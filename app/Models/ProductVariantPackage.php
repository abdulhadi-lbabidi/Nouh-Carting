<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
  'product_variant_id',
  'quantity',
  'price',
])]
class ProductVariantPackage extends Model
{
  public function variant()
  {
    return $this->belongsTo(ProductVariant::class, 'product_variant_id');
  }
}
