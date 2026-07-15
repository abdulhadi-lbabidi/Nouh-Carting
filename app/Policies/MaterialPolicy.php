<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;

class MaterialPolicy
{
  /**
   * Create a new policy instance.
   */
  public function __construct()
  {
    //
  }

  public function viewAny(User $user): bool
  {
    return $user->hasPermissionTo('view_material');
  }

  public function view(User $user, Material $material): bool
  {
    return $user->hasPermissionTo('view_material');
  }

  public function create(User $user): bool
  {
    return $user->hasPermissionTo('create_material');
  }

  public function update(User $user, Material $material): bool
  {
    return $user->hasPermissionTo('update_material');
  }

  public function delete(User $user, Material $material): bool
  {
    return $user->hasPermissionTo('delete_material');
  }
}
