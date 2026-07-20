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

  // public function createVariant(array $data, $imageFiles = null): ProductVariant
  // {
  //   return DB::transaction(function () use ($data, $imageFiles) {


  //     $variant = ProductVariant::create($data);

  //     if (!empty($data['packages'])) {
  //       $syncData = [];
  //       foreach ($data['packages'] as $package) {
  //         $syncData[$package['package_id']] = ['quantity' => $package['quantity']];
  //       }
  //       $variant->packages()->sync($syncData);
  //     }

  //     if ($imageFiles) {
  //       $this->attachMedia($variant, $imageFiles);
  //     }

  //     return $variant;
  //   });
  // }

  public function createBulkVariants(array $data): array
  {
    return DB::transaction(function () use ($data) {
      $createdVariants = [];
      $productId = $data['product_id'];

      foreach ($data['variants'] as $variantData) {

        $variant = ProductVariant::create([
          'product_id'     => $productId,
          'size_id'        => $variantData['size_id'],
          'material_id'    => $variantData['material_id'],
          'price'          => $variantData['price'],
          'discount'       => $variantData['discount'] ?? 0,
          'stock_quantity' => $variantData['stock_quantity'],
          'sku'            => $variantData['sku'],
          'barcode'        => $variantData['barcode'] ?? null,
        ]);

        if (!empty($variantData['packages'])) {
          $syncData = [];
          foreach ($variantData['packages'] as $package) {
            $syncData[$package['package_id']] = ['quantity' => $package['quantity']];
          }
          $variant->packages()->sync($syncData);
        }

        if (!empty($variantData['images'])) {
          foreach ($variantData['images'] as $file) {
            $variant->addMedia($file)->toMediaCollection('variants');
          }
        }

        $createdVariants[] = $variant;
      }

      return $createdVariants;
    });
  }

  // public function updateVariant(ProductVariant $variant, array $data, $imageFiles = null, array $deletedMediaIds = []): ProductVariant
  // {
  //   return DB::transaction(function () use ($variant, $data, $imageFiles, $deletedMediaIds) {
  //     $variant->update($data);

  //     if (isset($data['packages'])) {
  //       $syncData = [];
  //       foreach ($data['packages'] as $package) {
  //         $syncData[$package['package_id']] = ['quantity' => $package['quantity']];
  //       }
  //       $variant->packages()->sync($syncData);
  //     }

  //     if (!empty($deletedMediaIds)) {
  //       $mediaItems = $variant->media()->whereIn('id', $deletedMediaIds)->get();
  //       foreach ($mediaItems as $media) {
  //         $media->delete();
  //       }
  //     }

  //     if ($imageFiles) {
  //       $this->attachMedia($variant, $imageFiles);
  //     }

  //     return $variant;
  //   });
  // }

  public function updateBulkVariants(array $data): array
  {
    return DB::transaction(function () use ($data) {
      $updatedVariants = [];

      foreach ($data['variants'] as $variantData) {
        $variant = ProductVariant::findOrFail($variantData['id']);

        $variant->update([
          'size_id' => $variantData['size_id'] ?? $variant->size_id,
          'material_id' => $variantData['material_id'] ?? $variant->material_id,
          'price' => $variantData['price'] ?? $variant->price,
          'discount' => $variantData['discount'] ?? $variant->discount,
          'stock_quantity' => $variantData['stock_quantity'] ?? $variant->stock_quantity,
          'sku' => $variantData['sku'] ?? $variant->sku,
          'barcode' => $variantData['barcode'] ?? $variant->barcode,
        ]);

        if (isset($variantData['packages'])) {
          $syncData = [];
          foreach ($variantData['packages'] as $package) {
            $syncData[$package['package_id']] = ['quantity' => $package['quantity']];
          }
          $variant->packages()->sync($syncData);
        }

        if (!empty($variantData['deleted_media_ids'])) {
          $mediaItems = $variant->media()->whereIn('id', $variantData['deleted_media_ids'])->get();
          foreach ($mediaItems as $media) {
            $media->delete();
          }
        }

        if (!empty($variantData['images'])) {
          foreach ($variantData['images'] as $file) {
            $variant->addMedia($file)->toMediaCollection('variants');
          }
        }

        $updatedVariants[] = $variant;
      }

      return $updatedVariants;
    });
  }

  public function deleteVariant(ProductVariant $variant): ?bool
  {
    return DB::transaction(function () use ($variant) {
      $variant->packages()->detach();
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
