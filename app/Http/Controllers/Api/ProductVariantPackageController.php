<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantPackage\CreateProductVariantsPackage;
use App\Http\Requests\ProductVariantPackage\UpdateProductVariantsPackage;
use App\Http\Resources\ProductVariantPackageResource;
use App\Models\ProductVariantPackage;
use App\Services\ProductVariantPackageService;
use Illuminate\Http\Request;

class ProductVariantPackageController extends Controller
{
  public function __construct(
    private ProductVariantPackageService $packageService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $packages = $this->packageService->findAll($paginate, $perPage, $page);

    return ProductVariantPackageResource::collection($packages);
  }

  public function store(CreateProductVariantsPackage $request)
  {
    $validated = $request->validated();
    $package = $this->packageService->createPackage($validated);

    return new ProductVariantPackageResource($package);
  }

  public function show(ProductVariantPackage $package)
  {
    return new ProductVariantPackageResource($this->packageService->findOne($package));
  }

  public function update(ProductVariantPackage $package, UpdateProductVariantsPackage $request)
  {
    $validated = $request->validated();
    $updatedPackage = $this->packageService->updatePackage($package, $validated);

    return new ProductVariantPackageResource($updatedPackage);
  }

  public function destroy(ProductVariantPackage $package)
  {
    $this->packageService->deletePackage($package);

    return response()->json([
      'message' => 'Package deleted successfully'
    ], 200);
  }
}
