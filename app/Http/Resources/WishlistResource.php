<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,

      'product_variant' => $this->whenLoaded('productVariant', function () {
        return [
          'id' => $this->productVariant->id,
          'sku' => $this->productVariant->sku,
          'price' => $this->productVariant->price,
          'discount' => $this->productVariant->discount,
          'final_price' => $this->productVariant->final_price,
          'image' => $this->productVariant->getFirstMediaUrl('variants', 'default') ?: null,
          'product_name' => $this->productVariant->product?->translated_name,
        ];
      }),
      'created_at' => $this->created_at->format('Y-m-d H:i:s'),

    ];
  }
}
