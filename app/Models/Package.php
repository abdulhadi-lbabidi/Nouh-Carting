<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
  'name',
  'price',
])]
class Package extends Model
{

  protected $casts = [
    'name' => 'array',
  ];

  public function getTranslatedNameAttribute(): string
  {
    return $this->name[app()->getLocale()]
      ?? $this->name['en']
      ?? '';
  }



  public function variants()
  {
    return $this->belongsToMany(ProductVariant::class, 'package_product_variant')
      ->withPivot('quantity')
      ->withTimestamps();
  }
}
