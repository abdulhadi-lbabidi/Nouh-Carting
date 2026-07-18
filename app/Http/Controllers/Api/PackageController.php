<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\CreatePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Services\PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PackageController extends Controller
{
  public function __construct(
    private PackageService $packageService
  ) {}
  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $packages = $this->packageService->findAll($paginate, $perPage, $page);

    return PackageResource::collection($packages);
  }

  public function store(CreatePackageRequest $request)
  {
    Gate::authorize('create', Package::class);

    $validated = $request->validated();
    $package = $this->packageService->createPackage($validated);

    return new PackageResource($package);
  }

  public function show(Package $package)
  {
    return new PackageResource($this->packageService->findOne($package));
  }

  public function update(Package $package, UpdatePackageRequest $request)
  {
    Gate::authorize('update', $package);

    $validated = $request->validated();
    $updatedPackage = $this->packageService->updatePackage($package, $validated);

    return new PackageResource($updatedPackage);
  }

  public function destroy(Package $package)
  {
    Gate::authorize('delete', $package);

    if ($package->variants()->exists()) {
      return response()->json([
        'message' => 'Cannot delete this package because it is currently linked to product variants. Detach it from the products first.'
      ], 422);
    }

    $this->packageService->deletePackage($package);

    return response()->json([
      'message' => 'Package deleted successfully'
    ], 200);
  }
}
