<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    $allLanguages = filter_var($request->query('all_languages'), FILTER_VALIDATE_BOOLEAN);

    return [
      'id' => $this->id,

      'image' => $this->getFirstMediaUrl('variants', 'default') ?: null,

      'product_all_images' => $this->getMedia('variants')->map(function ($media) {
        return $media->getUrl('default');
      })->values(),
      'product' => $this->whenLoaded('product', function () use ($allLanguages) {
        return [
          'id' => $this->product->id,

          'name' => $allLanguages ? $this->product->name : $this->product->translated_name,
          'body' => $allLanguages ? $this->product->body : $this->product->translated_body,

          'category' => $this->product->category ? [
            'id' => $this->product->category->id,
            'name'        => $allLanguages ? $this->product->category->name : $this->product->category->translated_name,
            'description' => $allLanguages ? $this->product->category->description : $this->product->category->translated_description,
            'image' => $this->product->category->getFirstMediaUrl('categories', 'default') ?: null,
            'all_images' => $this->product->category->getMedia('categories')->map(function ($media) {
              return $media->getUrl('default');
            })->values(),
          ] : null,
        ];
      }),

      'packages' => $this->whenLoaded('packages', function () use ($allLanguages) {
        return $this->packages->map(function ($package) use ($allLanguages) {
          return [
            'id'       => $package->id,
            'name'     => $allLanguages ? $package->name : $package->translated_name,
            'price'    => $package->price,
            'quantity' => $package->pivot ? $package->pivot->quantity : null,
          ];
        });
      }),

      'price' => $this->price,
      'discount' => $this->discount,
      'final_price' => $this->final_price,
      'current_size' => $this->size ? $this->size->size : null,
      'current_material' => $this->material ? ($allLanguages ? $this->material->material : $this->material->translated_material) : null,
      'stock_quantity' => $this->stock_quantity,
      'sku' => $this->sku,
      'barcode' => $this->barcode,
      'created_at' => $this->created_at->format('Y-m-d H:i:s'),


      'reviews_avg' => $this->reviews_avg_rating ?? $this->reviews()->avg('rating') ?? 0,
      'reviews_count' => $this->reviews_count ?? $this->reviews()->count(),
    ];
  }
}
