<?php

namespace App\Http\Requests\material;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateMaterialRequest extends FormRequest
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
      'material' => ['required', 'array', 'max:255'],
      'material.en' => ['required', 'string', 'max:255'],
      'material.ar' => ['required', 'string', 'max:255'],
    ];
  }
}
