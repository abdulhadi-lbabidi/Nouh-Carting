<?php

namespace App\Services;

use App\Models\Package;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PackageService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"]
  ): LengthAwarePaginator|Collection {
    $query = Package::query();

    if ($paginate) {
      return $query->paginate(perPage: $perPage, page: $page, columns: $columns);
    }

    return $query->get($columns);
  }

  public function findOne(Package $package): Package
  {
    return $package;
  }

  public function createPackage(array $data): Package
  {
    return Package::create($data);
  }

  public function updatePackage(Package $package, array $data): Package
  {
    $package->update($data);
    return $package;
  }

  public function deletePackage(Package $package): ?bool
  {
    return $package->delete();
  }
}
