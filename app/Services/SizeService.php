<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Size;


class SizeService
{

  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"],
  ): LengthAwarePaginator|Collection {
    $query = Size::query();

    if ($paginate) {
      return $query->paginate(
        perPage: $perPage,
        page: $page,
        columns: $columns,
      );
    }

    return $query->get($columns);
  }

  public function createSize(array $data)
  {
    return Size::create($data);
  }

  public function findOne(Size $size)
  {
    return $size;
  }

  public function updateSize(Size $size, array $data)
  {
    $size->update($data);
    return $size;
  }

  public function deleteSize(Size $size)
  {
    return $size->delete();
  }
}
