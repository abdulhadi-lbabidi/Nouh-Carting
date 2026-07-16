<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


#[Fillable(['name', 'body', 'category_id', 'is_featured'])]
class Product extends Model
{
  use HasFactory;
  public function category()
  {
    return $this->belongsTo(Category::class);
  }


  public function variants()
  {
    return $this->hasMany(ProductVariant::class);
  }

  // for ar,en
  protected $casts = [
    'name' => 'array',
    'body' => 'array',
    'is_featured' => 'boolean',

  ];

  public function getTranslatedNameAttribute(): string
  {
    return $this->name[app()->getLocale()] ?? $this->name['en'] ?? '';
  }

  public function getTranslatedBodyAttribute(): string
  {
    return $this->body[app()->getLocale()] ?? $this->body['en'] ?? '';
  }
}