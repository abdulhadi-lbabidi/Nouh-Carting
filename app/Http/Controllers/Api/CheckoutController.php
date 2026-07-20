<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\CreateCheckoutRequest;
use App\Http\Requests\Checkout\UpdateCheckoutRequest;
use App\Http\Resources\CheckoutResource;
use App\Models\Checkout;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CheckoutController extends Controller
{
  public function __construct(
    private CheckoutService $checkoutService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $user = auth()->user();
    $userIdFilter = null;

    if ($user->hasRole('customer')) {
      $userIdFilter = $user->id;
    } else {
      Gate::authorize('viewAny', Checkout::class);
    }

    $checkouts = $this->checkoutService->findAll(
      paginate: $paginate,
      perPage: $perPage,
      page: $page,
      userId: $userIdFilter
    );

    return CheckoutResource::collection($checkouts);
  }

  public function store(CreateCheckoutRequest $request)
  {
    $checkout = $this->checkoutService->createCheckout(
      $request->validated(),
      Auth::id()
    );
    return new CheckoutResource($checkout);
  }

  public function update(UpdateCheckoutRequest $request, Checkout $checkout)
  {
    Gate::authorize('update', $checkout);

    $updated = $this->checkoutService->updateCheckout(
      $checkout,
      $request->validated()
    );

    return new CheckoutResource($updated);
  }

  public function show(Checkout $checkout)
  {
    Gate::authorize('view', $checkout);
    return new CheckoutResource($checkout);
  }

  public function destroy(Checkout $checkout)
  {
    Gate::authorize('delete', $checkout);

    $this->checkoutService->deleteCheckout($checkout);
    return response()->json(['message' => 'Checkout deleted']);
  }
}
