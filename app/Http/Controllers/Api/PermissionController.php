<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
  public function __construct(
    private PermissionService $permissionService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $permissions = $this->permissionService->findAll($paginate, $perPage, $page);

    return PermissionResource::collection($permissions);
  }
}
