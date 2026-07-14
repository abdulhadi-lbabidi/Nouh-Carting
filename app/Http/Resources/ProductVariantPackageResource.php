<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantPackageResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'quantity' => $this->quantity,
      'price' => $this->price,

      'variant' => $this->whenLoaded('variant', function () {
        return [
          'id' => $this->variant->id,
          'price' => $this->variant->price,
          'discount' => $this->variant->discount,
          'final_price' => $this->variant->final_price,
          'sku' => $this->variant->sku,
          'stock_quantity' => $this->variant->stock_quantity,
        ];
      }),
      'created_at' => $this->created_at->format('Y-m-d H:i:s'),

    ];
  }
}
