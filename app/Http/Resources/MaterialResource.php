<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    $allLanguages = filter_var($request->query('all_languages'), FILTER_VALIDATE_BOOLEAN);

    return [
      'id' => $this->id,

      'material' => $allLanguages ? $this->material : $this->translated_material,

      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
    ];
  }
}
