<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Material;


class MaterialService
{

  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"],
  ): LengthAwarePaginator|Collection {
    $query = Material::query();

    if ($paginate) {
      return $query->paginate(
        perPage: $perPage,
        page: $page,
        columns: $columns,
      );
    }

    return $query->get($columns);
  }

  public function createMaterial(array $data)
  {
    return Material::create($data);
  }

  public function findOne(Material $material)
  {
    return $material;
  }

  public function updateMaterial(Material $material, array $data)
  {
    $material->update($data);
    return $material;
  }

  public function deleteMaterial(Material $material)
  {
    return $material->delete();
  }
}
