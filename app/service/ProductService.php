<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
  public function findAll()
  {
    return Product::with([
      'category'
    ])->get();
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
