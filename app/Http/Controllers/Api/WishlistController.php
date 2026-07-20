<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wishlist\CreateWishlistRequest;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use App\Services\WishlistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WishlistController extends Controller
{
  public function __construct(
    private WishlistService $wishlistService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $wishlist = $this->wishlistService->findAllOfUser(auth()->id(), $paginate, $perPage, $page);

    return WishlistResource::collection($wishlist);
  }

  public function store(CreateWishlistRequest $request)
  {
    $validated = $request->validated();

    $wishlistItem = $this->wishlistService->addToWishlist($validated, auth()->id());

    return new WishlistResource($wishlistItem);
  }

  public function destroy(Wishlist $wishlist)
  {
    Gate::authorize('delete', $wishlist);

    $this->wishlistService->removeFromWishlist($wishlist);

    return response()->json([
      'message' => 'Removed from wishlist successfully'
    ], 200);
  }
}
