<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'rating' => $this->rating,
      'comment' => $this->comment,

      'user' => $this->whenLoaded('user', function () {
        return [
          'id' => $this->user->id,
          'name' => $this->user->name,
          'email' => $this->user->email,
        ];
      }),

      'product_variant' => $this->whenLoaded('productVariant', function () {
        return [
          'id' => $this->productVariant->id,
          'sku' => $this->productVariant->sku,
          'price' => $this->productVariant->price,
          'image' => $this->productVariant->getFirstMediaUrl('variants', 'default') ?: null,
        ];
      }),

      'created_at' => $this->created_at->format('Y-m-d H:i:s'),

    ];
  }
}
