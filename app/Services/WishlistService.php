<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class WishlistService
{
  public function findAllOfUser(
    int $userId,
    $paginate = false,
    $perPage = 10,
    $page = 1,
    $columns = ["*"]
  ): LengthAwarePaginator|Collection {
    $query = Wishlist::where('user_id', $userId)
      ->with(['productVariant.media', 'productVariant.product']);

    if ($paginate) {
      return $query->paginate(perPage: $perPage, page: $page, columns: $columns);
    }

    return $query->get($columns);
  }

  public function addToWishlist(array $data, int $userId): Wishlist
  {
    $data['user_id'] = $userId;

    return Wishlist::create($data);
  }

  public function removeFromWishlist(Wishlist $wishlist): ?bool
  {
    return $wishlist->delete();
  }
}
