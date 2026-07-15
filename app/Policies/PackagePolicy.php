<?php

namespace App\Policies;

use App\Models\Package;
use App\Models\User;

class PackagePolicy
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
    return $user->hasPermissionTo('view_package');
  }

  public function view(User $user, Package $package): bool
  {
    return $user->hasPermissionTo('view_package');
  }

  public function create(User $user): bool
  {
    return $user->hasPermissionTo('create_package');
  }

  public function update(User $user, Package $package): bool
  {
    return $user->hasPermissionTo('update_package');
  }

  public function delete(User $user, Package $package): bool
  {
    return $user->hasPermissionTo('delete_package');
  }
}
