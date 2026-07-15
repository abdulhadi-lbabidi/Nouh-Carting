<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
  public function __construct(
    private RoleService $roleService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $roles = $this->roleService->findAll($paginate, $perPage, $page);

    return RoleResource::collection($roles);
  }

  public function store(CreateRoleRequest $request)
  {
    Gate::authorize('create', Role::class);

    $validated = $request->validated();
    $role = $this->roleService->createRole($validated);

    return new RoleResource($role);
  }

  public function show(Role $role)
  {
    $roleWithRelations = $this->roleService->findOne($role);

    return new RoleResource($roleWithRelations);
  }

  public function update(Role $role, UpdateRoleRequest $request)
  {
    Gate::authorize('update', $role);

    $validated = $request->validated();
    $updatedRole = $this->roleService->updateRole($role, $validated);

    return new RoleResource($updatedRole);
  }

  public function destroy(Role $role)
  {
    Gate::authorize('delete', $role);

    $this->roleService->deleteRole($role);

    return response()->json([
      'message' => 'Role deleted successfully'
    ], 200);
  }
}
