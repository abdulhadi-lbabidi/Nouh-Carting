<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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

      'name' => $allLanguages ? $this->name : $this->translated_name,
      'description' => $allLanguages ? $this->description : $this->translated_description,

      'products_count' => $this->whenCounted('products'),

      'image' => $this->getFirstMediaUrl('categories', 'default') ?: null,
      'all_images' => $this->getMedia('categories')->map(function ($media) {
        // return $media->getUrl('default');
        return [
          'id'  => $media->id,
          'url' => $media->getUrl('default'),
        ];
      })->values(),

      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
    ];
  }
}
