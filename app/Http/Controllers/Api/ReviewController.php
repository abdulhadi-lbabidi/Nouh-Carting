<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\CreateReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
  public function __construct(
    private ReviewService $reviewService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $reviews = $this->reviewService->findAll($paginate, $perPage, $page);

    return ReviewResource::collection($reviews);
  }

  public function store(CreateReviewRequest $request)
  {
    $validated = $request->validated();

    $review = $this->reviewService->createReview($validated, auth()->id());

    return new ReviewResource($review);
  }

  public function show(Review $review)
  {
    return new ReviewResource($this->reviewService->findOne($review));
  }

  public function update(Review $review, UpdateReviewRequest $request)
  {
    Gate::authorize('update', $review);

    $validated = $request->validated();
    $updatedReview = $this->reviewService->updateReview($review, $validated);

    return new ReviewResource($updatedReview);
  }

  public function destroy(Review $review)
  {
    Gate::authorize('delete', $review);

    $this->reviewService->deleteReview($review);

    return response()->json([
      'message' => 'Review deleted successfully'
    ], 200);
  }
}
