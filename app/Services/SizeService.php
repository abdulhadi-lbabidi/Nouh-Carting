<?php

namespace App\Services;

use App\Models\Size;


class SizeService
{

  public function findAll()
  {
    return Size::all();
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
