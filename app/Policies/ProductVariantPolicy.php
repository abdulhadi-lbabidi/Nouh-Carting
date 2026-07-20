<?php

namespace App\Policies;

use App\Models\ProductVariant;
use App\Models\User;

class ProductVariantPolicy
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
    return $user->hasPermissionTo('view_product_variant');
  }

  public function view(User $user, ProductVariant $variant): bool
  {
    return $user->hasPermissionTo('view_product_variant');
  }

  public function create(User $user): bool
  {
    return $user->hasPermissionTo('create_product_variant');
  }

  public function update(User $user): bool
  {
    return $user->hasPermissionTo('update_product_variant');
  }

  public function delete(User $user, ProductVariant $variant): bool
  {
    return $user->hasPermissionTo('delete_product_variant');
  }
}
