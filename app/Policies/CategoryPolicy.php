<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
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
    return $user->hasPermissionTo('view_category');
  }

  public function view(User $user, Category $category): bool
  {
    return $user->hasPermissionTo('view_category');
  }

  public function create(User $user): bool
  {
    return $user->hasPermissionTo('create_category');
  }

  public function update(User $user, Category $category): bool
  {
    return $user->hasPermissionTo('update_category');
  }

  public function delete(User $user, Category $category): bool
  {
    return $user->hasPermissionTo('delete_category');
  }
}
