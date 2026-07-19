<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleService
{
  public function findAll(
    bool $paginate = false,
    int $perPage = 10,
    int $page = 1,
    array $columns = ["*"]
  ): LengthAwarePaginator|Collection {

    $query = Role::query();

    if ($paginate) {
      return $query->paginate(
        perPage: $perPage,
        page: $page,
        columns: $columns,
      );
    }

    return $query->get($columns);
  }

  public function findOne(Role $role): Role
  {
    return $role->load(['permissions']);
  }

  public function createRole(array $data): Role
  {
    $role = Role::create([
      'name' => $data['name'],
      'guard_name' => 'api',
    ]);

    if (!empty($data['permissions'])) {
      $role->syncPermissions($data['permissions']);
    }

    return $role->load(['permissions']);
  }

  public function updateRole(Role $role, array $data): Role
  {
    if (isset($data['name'])) {
      $role->update([
        'name' => $data['name'],
      ]);
    }

    if (isset($data['permissions'])) {
      $role->syncPermissions($data['permissions']);
    }

    return $role->load(['permissions']);
  }

  public function deleteRole(Role $role): bool
  {
    try {
      return $role->delete();
    } catch (\Throwable $e) {
      dd(
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        $e->getTraceAsString()
      );
    }
  }
}
