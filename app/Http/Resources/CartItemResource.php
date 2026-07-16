<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    $variant = $this->productVariant;
    $product = $variant ? $variant->product : null;

    return [
      'id' => $this->id,
      'quantity' => $this->quantity,
      'created_at' => $this->created_at->format('Y-m-d H:i:s'),

      'product' => $product ? [
        'id' => $product->id,
        'name' => $product->translated_name,
      ] : null,

      'variant' => $variant ? [
        'id' => $variant->id,

        'image' => $variant->getFirstMediaUrl('variants', 'default') ?: null,

        'product_all_images' => $variant->getMedia('variants')->map(function ($media) {
          return $media->getUrl('default');
        })->values(),

        'price' => (float)$variant->price,
        'discount' => (float)$variant->discount,
        'final_price' => (float)$variant->final_price,
        'stock_quantity' => (int)$variant->stock_quantity,
        'sku' => $variant->sku,

        'size' => $variant->size ? [
          'id' => $variant->size->id,
          'size' => $variant->size->size,
        ] : null,

        'material' => $variant->material ? [
          'id' => $variant->material->id,
          'material' => $variant->material->translated_material,
        ] : null,
      ] : null,
    ];
  }
}
