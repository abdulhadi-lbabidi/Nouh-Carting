<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{

  public function viewStats(User $user): bool
  {
    return $user->hasRole('admin') || $user->hasPermissionTo('view_dashboard');
  }
}
