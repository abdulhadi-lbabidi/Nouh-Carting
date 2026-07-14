<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariant\CreateProductVariantRequest;
use App\Http\Requests\ProductVariant\UpdateProductVariantRequest;
use App\Http\Resources\ProductVariantResource;
use App\Models\ProductVariant;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
  public function __construct(
    private ProductVariantService $variantService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $variants = $this->variantService->findAll($paginate, $perPage, $page);

    return ProductVariantResource::collection($variants);
  }

  public function store(CreateProductVariantRequest $request)
  {
    $validated = $request->validated();

    $variant = $this->variantService->createVariant(
      $validated,
      $request->file('images')
    );

    return new ProductVariantResource($variant);
  }

  public function show(ProductVariant $variant)
  {
    return new ProductVariantResource($this->variantService->findOne($variant));
  }

  public function update(ProductVariant $variant, UpdateProductVariantRequest $request)
  {
    $validated = $request->validated();
    $deletedMediaIds = $request->input('deleted_media_ids', []);

    $updatedVariant = $this->variantService->updateVariant(
      $variant,
      $validated,
      $request->file('images'),
      $deletedMediaIds
    );

    return new ProductVariantResource($updatedVariant);
  }

  public function destroy(ProductVariant $variant)
  {
    $this->variantService->deleteVariant($variant);

    return response()->json([
      'message' => 'Variant deleted successfully'
    ], 200);
  }
}
