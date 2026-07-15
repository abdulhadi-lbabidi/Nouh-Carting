<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
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
    return $user->hasPermissionTo('view_product');
  }

  public function view(User $user, Product $product): bool
  {
    return $user->hasPermissionTo('view_product');
  }

  public function create(User $user): bool
  {
    return $user->hasPermissionTo('create_product');
  }

  public function update(User $user, Product $product): bool
  {
    return $user->hasPermissionTo('update_product');
  }

  public function delete(User $user, Product $product): bool
  {
    return $user->hasPermissionTo('delete_product');
  }
}
