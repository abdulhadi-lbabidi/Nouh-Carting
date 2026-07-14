<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,

      'image' => $this->getFirstMediaUrl('variants', 'default') ?: null,

      'product_all_images' => $this->getMedia('variants')->map(function ($media) {
        return $media->getUrl('default');
      })->values(),

      'product' => $this->whenLoaded('product', function () {
        return [
          'id' => $this->product->id,
          'name' => $this->product->translated_name,
          'body' => $this->product->translated_body,
          'category' => $this->product->category ? [
            'id' => $this->product->category->id,
            'name' => $this->product->category->translated_name,
            'description' => $this->product->category->translated_description,
            'image' => $this->product->category->getFirstMediaUrl('categories', 'default') ?: null,
            'all_images' => $this->product->category->getMedia('categories')->map(function ($media) {
              return $media->getUrl('default');
            })->values(),
          ] : null,
        ];
      }),

      'packages' => $this->whenLoaded('packages', function () {
        return $this->packages->map(function ($package) {
          return [
            'id' => $package->id,
            'quantity' => $package->quantity,
            'price' => $package->price,
          ];
        });
      }),

      'price' => $this->price,
      'discount' => $this->discount,
      'final_price' => $this->final_price,
      'current_size' => $this->size ? $this->size->size : null,
      'current_material' => $this->material ? $this->material->translated_material : null,
      'stock_quantity' => $this->stock_quantity,
      'sku' => $this->sku,
      'barcode' => $this->barcode,
      'created_at' => $this->created_at->format('Y-m-d H:i:s'),


      // حسابات التقييمات التلقائية من العلاقة
      'reviews_avg' => $this->reviews_avg_rating ?? $this->reviews()->avg('rating') ?? 0,
      'reviews_count' => $this->reviews_count ?? $this->reviews()->count(),
    ];
  }
}
