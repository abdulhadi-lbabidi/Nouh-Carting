<?php

namespace App\Models;

use App\MediaLibrary\ProductVariantPathGenerator;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGeneratorFactory;

#[Fillable([
  'product_id',
  'size_id',
  'material_id',
  'price',
  'discount',
  'stock_quantity',
  'sku',
  'barcode'
])]
class ProductVariant extends Model implements HasMedia
{

  use HasFactory, InteractsWithMedia;

  protected static function booting(): void
  {
    PathGeneratorFactory::setCustomPathGenerators(
      static::class,
      ProductVariantPathGenerator::class
    );
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->addMediaConversion('default')
      ->fit(Fit::Max, 1000, 1000)
      ->quality(70)
      ->format('webp')
      ->nonQueued();
  }


  public static function generateUniqueBarcode()
  {
    do {
      $barcode = mt_rand(100000000000, 999999999999);
    } while (self::where('barcode', $barcode)->exists());

    return $barcode;
  }

  public static function generateUniqueSku()
  {
    do {
      $sku = 'PROD-' . strtoupper(Str::random(8));
    } while (self::where('sku', $sku)->exists());

    return $sku;
  }

  public function getFinalPriceAttribute()
  {
    $discountedAmount = $this->price * ($this->discount / 100);
    return round($this->price - $discountedAmount, 2);
  }

  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  */
  public function packages()
  {
    return $this->hasMany(ProductVariantPackage::class, 'product_variant_id');
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function size()
  {
    return $this->belongsTo(Size::class);
  }

  public function material()
  {
    return $this->belongsTo(Material::class);
  }

  public function wishlists()
  {
    return $this->hasMany(Wishlist::class);
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }
}
