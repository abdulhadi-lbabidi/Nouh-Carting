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

  public function createCategory(array $data, $imageFiles = null)
  {
    $category = Category::create($data);

    if ($imageFiles) {
      $this->attachMedia($category, $imageFiles);
    }

    return $category;
  }

  public function updateCategory(Category $category, array $data, $imageFiles = null, array $deletedMediaIds = [])
  {
    $category->update($data);

    if (!empty($deletedMediaIds)) {
      $mediaItems = $category->media()->whereIn('id', $deletedMediaIds)->get();

      foreach ($mediaItems as $media) {
        $media->delete();
      }
    }

    if ($imageFiles) {
      $this->attachMedia($category, $imageFiles);
    }

    return $category;
  }

  public function deleteCategory(Category $category)
  {
    return $category->delete();
  }

  private function attachMedia(Category $category, $imageFiles)
  {
    $files = is_array($imageFiles) ? $imageFiles : [$imageFiles];

    foreach ($files as $file) {
      if ($file) {
        $category->addMedia($file)->toMediaCollection('categories');
      }
    }
  }
}
