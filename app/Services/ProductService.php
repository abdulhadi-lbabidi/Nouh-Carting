<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"],
  ): LengthAwarePaginator|Collection {

    $filters = [
      AllowedFilter::exact('category_id'),
      AllowedFilter::exact('is_featured'),

      AllowedFilter::callback('search', function ($query, $value) {
        $query->where(function ($q) use ($value) {
          $q->where('name->en', 'like', "%{$value}%")
            ->orWhere('name->ar', 'like', "%{$value}%")
            ->orWhere('body->en', 'like', "%{$value}%")
            ->orWhere('body->ar', 'like', "%{$value}%");
        });
      }),

      AllowedFilter::callback('size_id', function ($query, $value) {
        $query->whereHas('variants', fn($q) => $q->where('size_id', $value));
      }),

      AllowedFilter::callback('material_id', function ($query, $value) {
        $query->whereHas('variants', fn($q) => $q->where('material_id', $value));
      }),

      AllowedFilter::callback('min_price', function ($query, $value) {
        $query->whereHas('variants', fn($q) => $q->where('price', '>=', $value));
      }),

      AllowedFilter::callback('max_price', function ($query, $value) {
        $query->whereHas('variants', fn($q) => $q->where('price', '<=', $value));
      }),
    ];

    $query = QueryBuilder::for(Product::class)
      ->with([
        'category',
        'variants.size',
        'variants.material',
        'variants.packages',
        'variants.media'
      ])
      ->allowedFilters(...$filters)
      ->defaultSort('-created_at');

    if ($paginate) {
      return $query->paginate(
        perPage: $perPage,
        page: $page,
        columns: $columns,
      );
    }

    return $query->get($columns);
  }
  public function findFeatured()
  {
    return Product::with('category')
      ->where('is_featured', true)
      ->latest()
      ->get();
  }

  public function createProduct(array $data)
  {
    return Product::create($data);
  }

  public function findOne(Product $product)
  {
    return $product;
  }

  public function updateProduct(Product $product, array $data)
  {
    $product->update($data);
    return $product;
  }

  public function deleteProduct(Product $product)
  {
    return $product->delete();
  }
}
