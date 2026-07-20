<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReviewService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"]
  ): LengthAwarePaginator|Collection {

    $filters = [
      AllowedFilter::exact('product_variant_id'),
    ];

    $query = QueryBuilder::for(Review::class)
      ->with(['user', 'productVariant.media'])
      ->allowedFilters(...$filters)
      ->defaultSort('-created_at');

    if ($paginate) {
      return $query->paginate(perPage: $perPage, page: $page, columns: $columns);
    }

    return $query->get($columns);
  }
  public function findOne(Review $review): Review
  {
    return $review->load(['user', 'productVariant']);
  }

  public function createReview(array $data, int $userId): Review
  {
    $data['user_id'] = $userId;

    return Review::create($data);
  }

  public function updateReview(Review $review, array $data): Review
  {
    $review->update($data);
    return $review;
  }

  public function deleteReview(Review $review): ?bool
  {
    return $review->delete();
  }
}
