<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{

  public function viewAny(User $user): bool
  {
    return $user->hasPermissionTo('view_order');
  }


  public function view(User $user, Order $order): bool
  {
    return $user->id === $order->user_id || $user->hasPermissionTo('view_order');
  }


  public function update(User $user, Order $order): bool
  {
    return $user->hasPermissionTo('update_order');
  }


  public function delete(User $user, Order $order): bool
  {
    return $user->hasPermissionTo('delete_order');
  }
}
