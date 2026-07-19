<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
      'id'           => $this->id,
      'name'         => $this->name,
      'display_name' => $allLanguages ? $this->display_name : $this->getTranslatedDisplayNameAttribute(),
      'guard_name'   => $this->guard_name,
    ];
  }
}
