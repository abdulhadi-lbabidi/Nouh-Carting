<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
  public function findAll()
  {
    return Category::with(['media'])->get();
  }

  public function findOne(Category $category)
  {
    return $category->load(['media']);
  }

  public function createCategory(array $data, $imageFile = null)
  {
    $category = Category::create($data);

    if ($imageFile) {
      $category->addMedia($imageFile)->toMediaCollection('categories');
    }

    return $category;
  }

  public function updateCategory(Category $category, array $data, $imageFile = null)
  {
    $category->update($data);

    if ($imageFile) {
      $category->clearMediaCollection('categories');
      $category->addMedia($imageFile)->toMediaCollection('categories');
    }

    return $category;
  }
  public function deleteCategory(Category $category)
  {
    return $category->delete();
  }
}
