<?php

namespace App\Services;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductVariantService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"]
  ): LengthAwarePaginator|Collection {
    $query = ProductVariant::with([
      'media',
      'product.category',
      'size',
      'material',
      'packages'
    ])
      ->withAvg('reviews', 'rating')
      ->withCount('reviews');

    if ($paginate) {
      return $query->paginate(perPage: $perPage, page: $page, columns: $columns);
    }

    return $query->get($columns);
  }

  public function findOne(ProductVariant $variant): ProductVariant
  {
    return $variant->load([
      'media',
      'product.category',
      'size',
      'material',
      'packages'
    ])
      ->loadAvg('reviews', 'rating')
      ->loadCount('reviews');
  }

  public function createVariant(array $data, $imageFiles = null): ProductVariant
  {
    return DB::transaction(function () use ($data, $imageFiles) {
      // توليد التلقائي للبيانات الفريدة
      $data['sku'] = ProductVariant::generateUniqueSku();
      $data['barcode'] = ProductVariant::generateUniqueBarcode();

      $variant = ProductVariant::create($data);

      // حفظ الـ Packages إن وجدت
      if (!empty($data['packages'])) {
        $variant->packages()->createMany($data['packages']);
      }

      // رفع الصور
      if ($imageFiles) {
        $this->attachMedia($variant, $imageFiles);
      }

      return $variant;
    });
  }

  public function updateVariant(ProductVariant $variant, array $data, $imageFiles = null, array $deletedMediaIds = []): ProductVariant
  {
    return DB::transaction(function () use ($variant, $data, $imageFiles, $deletedMediaIds) {
      $variant->update($data);

      // تحديث الـ Packages (حذف القديم وإضافة الجديد في حال تم إرسالها)
      if (isset($data['packages'])) {
        $variant->packages()->delete();
        if (!empty($data['packages'])) {
          $variant->packages()->createMany($data['packages']);
        }
      }

      // حذف الصور المحددة في التعديل
      if (!empty($deletedMediaIds)) {
        $mediaItems = $variant->media()->whereIn('id', $deletedMediaIds)->get();
        foreach ($mediaItems as $media) {
          $media->delete();
        }
      }

      // إضافة الصور الجديدة
      if ($imageFiles) {
        $this->attachMedia($variant, $imageFiles);
      }

      return $variant;
    });
  }

  public function deleteVariant(ProductVariant $variant): ?bool
  {
    return DB::transaction(function () use ($variant) {
      // حزم الـ Spatie تحذف ملفات الـ media تلقائياً عند حذف الـ Model المرتبط بها
      $variant->packages()->delete();
      return $variant->delete();
    });
  }

  private function attachMedia(ProductVariant $variant, $imageFiles)
  {
    $files = is_array($imageFiles) ? $imageFiles : [$imageFiles];

    foreach ($files as $file) {
      if ($file) {
        $variant->addMedia($file)->toMediaCollection('variants');
      }
    }
  }
}
