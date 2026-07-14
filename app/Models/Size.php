<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['size'])]
class Size extends Model
{
  public function productVariants()
  {
    return $this->hasMany(ProductVariant::class);
  }
}
