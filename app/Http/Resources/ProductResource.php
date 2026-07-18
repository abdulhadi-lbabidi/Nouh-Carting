<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    // return [
    // 'id' => $this->id,
    // 'name' => $this->translated_name,
    // 'body' => $this->translated_body,
    // // category
    // 'category' => new CategoryResource($this->whenLoaded('category')),
    // 'is_featured' => $this->is_featured,
    // 'variants' => ProductVariantResource::collection(
    //   $this->whenLoaded('variants')
    // ),
    // ];

    $allLanguages = filter_var($request->query('all_languages'), FILTER_VALIDATE_BOOLEAN);

    $availableOptions = $this->variants->groupBy('material_id')->map(function ($materialGroup) {
      $material = $materialGroup->first()->material;
      if (!$material) return null;

      return [
        'material_id'   => $material->id,
        'material_name' => $material->translated_material,

        'available_sizes' => $materialGroup->map(function ($variant) {
          return [
            'variant_id'     => $variant->id,
            'size_id'        => $variant->size?->id,
            'size_name'      => $variant->size?->size,
            'stock_quantity' => $variant->stock_quantity,
            'price'          => $variant->price,
            'discount'       => $variant->discount,
            'final_price'    => $variant->final_price,
            'sku'            => $variant->sku,
            'barcode'        => $variant->barcode,

            'images' => $variant->getMedia('variants')->map(function ($media) {
              return $media->getUrl('default');
            })->values(),

            'packages' => $variant->packages->map(function ($package) {
              return [
                'id'       => $package->id,
                'name'     => $package->translated_name,
                'price'    => $package->price,
                'quantity' => $package->pivot ? $package->pivot->quantity : null,
              ];
            })->values(),
          ];
        })->values(),
      ];
    })->filter()->values();

    $defaultVariant = $this->variants->first();

    return [
      'id'          => $this->id,
      'name' => $allLanguages ? $this->name : $this->translated_name,
      'body' => $allLanguages ? $this->body : $this->translated_body,


      'is_featured' => $this->is_featured,

      'image' => $defaultVariant ? $defaultVariant->getFirstMediaUrl('variants', 'default') ?: null : null,

      'all_images' => $this->variants->flatMap(function ($v) {
        return $v->getMedia('variants')->map(fn($media) => $media->getUrl('default'));
      })->unique()->values(),

      'category' => $this->category ? [
        'id'          => $this->category->id,
        'name'        => $this->category->translated_name,
        'description' => $this->category->translated_description,
      ] : null,

      'available_options' => $availableOptions,

      'price'       => $defaultVariant?->price,
      'discount'    => $defaultVariant?->discount,
      'final_price' => $defaultVariant?->final_price,
      'stock'       => $defaultVariant?->stock_quantity,
      'sku'         => $defaultVariant?->sku,
    ];
  }
}
