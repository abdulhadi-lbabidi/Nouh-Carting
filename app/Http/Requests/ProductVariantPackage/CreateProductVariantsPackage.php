<?php

namespace App\Http\Requests\ProductVariantPackage;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductVariantsPackage extends FormRequest
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
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'product_variant_id' => [
        'required',
        'exists:product_variants,id',
      ],

      'quantity' => [
        'required',
        'integer',
        'min:1',
        Rule::unique('product_variant_packages')
          ->where(
            fn($q) =>
            $q->where('product_variant_id', $this->product_variant_id)
          ),
      ],

      'price' => [
        'required',
        'numeric',
        'min:0',
      ],
    ];
  }
}
