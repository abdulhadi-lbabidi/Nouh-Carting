<?php

namespace App\Http\Requests\Wishlist;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateWishlistRequest extends FormRequest
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
        Rule::unique('wishlists')->where(function ($query) {
          return $query->where('user_id', auth()->id());
        }),
      ],
    ];
  }
}
