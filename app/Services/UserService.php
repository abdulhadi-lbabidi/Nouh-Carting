<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"],
  ): LengthAwarePaginator|Collection {

    $query = User::with(['roles']);

    if ($paginate) {
      return $query->paginate(
        perPage: $perPage,
        page: $page,
        columns: $columns,
      );
    }

    return $query->get($columns);
  }

  public function findOne(User $user)
  {
    return $user->load(['roles.permissions']);
  }

  public function createUser(array $data)
  {
    $user = User::create($data);

    if (!empty($data['roles'])) {
      $roles = Role::whereIn('id', $data['roles'])->get();
      $user->syncRoles($roles);
    }

    return $user->load(['roles']);
  }

  public function updateUser(User $user, array $data)
  {
    if (empty($data['password'])) {
      unset($data['password']);
    }

    $user->update($data);

    if (isset($data['roles'])) {
      $roles = Role::whereIn('id', $data['roles'])->get();
      $user->syncRoles($roles);
    }

    return $user->load(['roles']);
  }

  public function deleteUser(User $user)
  {
    return $user->delete();
  }
}
