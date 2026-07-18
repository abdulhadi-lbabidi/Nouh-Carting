<?php

namespace App\Http\Requests\ProductVariant;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductVariantRequest extends FormRequest
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
    return [
      'product_id' => ['required', 'exists:products,id'],
      'size_id' => ['required', 'exists:sizes,id'],
      'material_id' => ['required', 'exists:materials,id'],
      'price' => ['required', 'numeric', 'min:0'],
      'discount' => ['nullable', 'numeric', 'min:0'],
      'stock_quantity' => ['required', 'integer', 'min:0'],
      'barcode' => ['nullable', 'string', 'unique:product_variants,barcode'],
      'sku' => ['nullable', 'string', 'unique:product_variants,sku'],

      'images' => ['nullable', 'array'],
      'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:10240'], // 10MB

      'packages' => ['nullable', 'array'],
      'packages.*.package_id' => ['required_with:packages', 'exists:packages,id'],
      'packages.*.quantity'   => ['required_with:packages', 'integer', 'min:1'],
    ];
  }
}
