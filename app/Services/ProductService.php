<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;

class ProductService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"],
  ): LengthAwarePaginator|Collection {
    $query = Product::with(['category']);

    if ($paginate) {
      return $query->paginate(
        perPage: $perPage,
        page: $page,
        columns: $columns,
      );
    }

    return $query->get($columns);
  }

  public function findFeatured()
  {
    return Product::with('category')
      ->where('is_featured', true)
      ->latest()
      ->get();
  }

  public function createProduct(array $data)
  {
    return Product::create($data);
  }

  public function findOne(Product $product)
  {
    return $product;
  }

  public function updateProduct(Product $product, array $data)
  {
    $product->update($data);
    return $product;
  }

  public function deleteProduct(Product $product)
  {
    return $product->delete();
  }
}
