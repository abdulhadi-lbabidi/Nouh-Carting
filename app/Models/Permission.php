<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
  protected $fillable = [
    'name',
    'display_name',
    'guard_name',
  ];

  protected $casts = [
    'display_name' => 'array',
  ];

  public function getTranslatedDisplayNameAttribute(): string
  {
    return $this->display_name[app()->getLocale()]
      ?? $this->display_name['en']
      ?? '';
  }
}
