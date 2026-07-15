<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id'    => $this->id,
      'name' => $this->translated_name,
      'price' => $this->price,

      'quantity' => $this->whenPivotLoaded('package_product_variant', function () {
        return $this->pivot->quantity;
      }),
      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
    ];
  }
}
