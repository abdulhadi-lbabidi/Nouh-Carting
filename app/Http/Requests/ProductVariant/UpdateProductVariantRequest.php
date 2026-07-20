<?php

namespace App\Http\Requests\ProductVariant;

use App\Models\ProductVariant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductVariantRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    // $variantId = $this->route('product_variant')?->id;

    // return [
    //   'product_id' => ['sometimes', 'exists:products,id'],
    //   'size_id' => ['sometimes', 'exists:sizes,id'],
    //   'material_id' => ['sometimes', 'exists:materials,id'],
    //   'price' => ['sometimes', 'numeric', 'min:0'],
    //   'discount' => ['sometimes', 'numeric', 'min:0'],
    //   'stock_quantity' => ['sometimes', 'integer', 'min:0'],

    //   'barcode' => [
    //     'sometimes',
    //     'string',
    //     Rule::unique('product_variants', 'barcode')->ignore($variantId)
    //   ],
    //   'sku' => [
    //     'sometimes',
    //     'string',
    //     Rule::unique('product_variants', 'sku')->ignore($variantId)
    //   ],
    //   'images' => ['nullable', 'array'],
    //   'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:10240'], // 10MB

    //   'deleted_media_ids'   => ['nullable', 'array'],
    //   'deleted_media_ids.*' => ['integer', 'exists:media,id'],

    //   'packages' => ['nullable', 'array'],
    //   'packages.*.package_id' => ['required_with:packages', 'exists:packages,id'],
    //   'packages.*.quantity'   => ['required_with:packages', 'integer', 'min:1'],
    // ];

    return [
      'product_id' => ['sometimes', 'exists:products,id'],

      'variants' => ['required', 'array', 'min:1'],

      'variants.*.id' => ['required', 'exists:product_variants,id'],

      'variants.*.size_id' => ['sometimes', 'exists:sizes,id'],
      'variants.*.material_id' => ['sometimes', 'exists:materials,id'],
      'variants.*.price' => ['sometimes', 'numeric', 'min:0'],
      'variants.*.discount' => ['sometimes', 'numeric', 'min:0'],
      'variants.*.stock_quantity' => ['sometimes', 'integer', 'min:0'],

      'variants.*.sku' => [
        'sometimes',
        'string',
        function ($attribute, $value, $fail) {
          $index = explode('.', $attribute)[1];
          $variantId = $this->input("variants.{$index}.id");
          if (ProductVariant::where('sku', $value)->where('id', '!=', $variantId)->exists()) {
            $fail("The sku has already been taken.");
          }
        }
      ],
      'variants.*.barcode' => [
        'sometimes',
        'string',
        function ($attribute, $value, $fail) {
          $index = explode('.', $attribute)[1];
          $variantId = $this->input("variants.{$index}.id");
          if (ProductVariant::where('barcode', $value)->where('id', '!=', $variantId)->exists()) {
            $fail("The barcode has already been taken.");
          }
        }
      ],

      'variants.*.images' => ['nullable', 'array'],
      'variants.*.images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],

      'variants.*.deleted_media_ids' => ['nullable', 'array'],
      'variants.*.deleted_media_ids.*' => ['integer', 'exists:media,id'],

      'variants.*.packages' => ['nullable', 'array'],
      'variants.*.packages.*.package_id' => ['required_with:variants.*.packages', 'exists:packages,id'],
      'variants.*.packages.*.quantity' => ['required_with:variants.*.packages', 'integer', 'min:1'],
    ];
  }
}
