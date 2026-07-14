<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'product_variant_id'])]
class Wishlist extends Model
{
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function productVariant()
  {
    return $this->belongsTo(ProductVariant::class, 'product_variant_id');
  }
}
