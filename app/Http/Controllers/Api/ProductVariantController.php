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
  ) {
    $this->authorizeResource(ProductVariant::class, 'product_variant', [
      'except' => ['index', 'show']
    ]);
  }
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

  public function show(ProductVariant $product_variant)
  {
    return new ProductVariantResource($this->variantService->findOne($product_variant));
  }

  public function update(ProductVariant $product_variant, UpdateProductVariantRequest $request)
  {
    $validated = $request->validated();
    $deletedMediaIds = $request->input('deleted_media_ids', []);

    $updatedVariant = $this->variantService->updateVariant(
      $product_variant,
      $validated,
      $request->file('images'),
      $deletedMediaIds
    );

    return new ProductVariantResource($updatedVariant);
  }

  public function destroy(ProductVariant $product_variant)
  {
    $this->variantService->deleteVariant($product_variant);

    return response()->json([
      'message' => 'Variant deleted successfully'
    ], 200);
  }
}
