<?php

namespace App\Services;

use App\Models\Material;


class MaterialService
{

  public function findAll()
  {
    return Material::all();
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
