<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'quantity' => $this->quantity,
      'price' => $this->price,
      'total' => $this->total,
      'product_name' => $this->productVariant?->product?->translated_name,
      'variant' => $this->productVariant ? [
        'id' => $this->productVariant->id,
        'size' => $this->productVariant->size?->name,
        'material' => $this->productVariant->material?->name,
      ] : null,
    ];
  }
}
