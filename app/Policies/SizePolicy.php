<?php

namespace App\Policies;

use App\Models\Size;
use App\Models\User;

class SizePolicy
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
    return $user->hasPermissionTo('view_size');
  }

  public function view(User $user, Size $size): bool
  {
    return $user->hasPermissionTo('view_size');
  }

  public function create(User $user): bool
  {
    return $user->hasPermissionTo('create_size');
  }

  public function update(User $user, Size $size): bool
  {
    return $user->hasPermissionTo('update_size');
  }

  public function delete(User $user, Size $size): bool
  {
    return $user->hasPermissionTo('delete_size');
  }
}
