<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
  public function __construct(
    private ProductService $productService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $products = $this->productService->findAll($paginate, $perPage, $page);

    return ProductResource::collection($products);
  }

  public function featured()
  {
    $featuredProducts = $this->productService->findFeatured();
    return ProductResource::collection($featuredProducts);
  }

  public function store(CreateProductRequest $request)
  {
    Gate::authorize('create', Product::class);

    $validated = $request->validated();
    $product = $this->productService->createProduct(
      $validated,
    );
    return new ProductResource($product);
  }

  public function show(Product $product)
  {
    $product->load('category');

    return new ProductResource($product);
  }

  public function update(Product $product, UpdateProductRequest $request)
  {
    Gate::authorize('update', $product);

    $validated = $request->validated();

    $newProduct = $this->productService->updateProduct(
      $product,
      $validated,
    );

    return new ProductResource($newProduct);
  }
  public function destroy(Product $product)
  {
    Gate::authorize('delete', $product);

    $product = $this->productService->deleteProduct($product);
    return response()->json(['message' => 'Product deleted successfully']);
  }
}
