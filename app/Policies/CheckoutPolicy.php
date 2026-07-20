<?php

namespace App\Policies;

use App\Models\Checkout;
use App\Models\User;

class CheckoutPolicy
{

  public function viewAny(User $user): bool
  {
    return $user->hasPermissionTo('view_checkout');
  }


  public function view(User $user, Checkout $checkout): bool
  {
    return $user->id === $checkout->user_id || $user->hasPermissionTo('view_checkout');
  }


  public function update(User $user, Checkout $checkout): bool
  {
    return $user->id === $checkout->user_id || $user->hasPermissionTo('update_checkout');
  }


  public function delete(User $user, Checkout $checkout): bool
  {
    return $user->hasPermissionTo('delete_checkout');
  }
}
