<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['material'])]
class Material extends Model
{
  public function productVariants()
  {
    return $this->hasMany(ProductVariant::class);
  }

  protected $casts = [
    'material' => 'array',
  ];


  public function getTranslatedMaterialAttribute(): string
  {
    return $this->material[app()->getLocale()]
      ?? $this->material['en']
      ?? '';
  }
}
