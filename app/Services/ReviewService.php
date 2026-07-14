<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ReviewService
{
  public function findAll(
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"]
  ): LengthAwarePaginator|Collection {
    $query = Review::with(['user', 'productVariant']);

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
