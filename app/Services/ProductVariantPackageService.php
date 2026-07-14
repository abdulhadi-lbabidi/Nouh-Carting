<?php

namespace App\Services;

use App\Models\ProductVariantPackage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductVariantPackageService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"]
  ): LengthAwarePaginator|Collection {
    $query = ProductVariantPackage::with(['variant']);

    if ($paginate) {
      return $query->paginate(perPage: $perPage, page: $page, columns: $columns);
    }

    return $query->get($columns);
  }

  public function findOne(ProductVariantPackage $package): ProductVariantPackage
  {
    return $package->load(['variant']);
  }

  public function createPackage(array $data): ProductVariantPackage
  {
    return ProductVariantPackage::create($data);
  }

  public function updatePackage(ProductVariantPackage $package, array $data): ProductVariantPackage
  {
    $package->update($data);
    return $package;
  }

  public function deletePackage(ProductVariantPackage $package): ?bool
  {
    return $package->delete();
  }
}
