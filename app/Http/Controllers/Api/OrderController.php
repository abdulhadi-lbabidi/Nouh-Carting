<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
  public function __construct(
    private OrderService $orderService
  ) {}

  public function index(Request $request)
  {
    $user = auth()->user();
    $userIdFilter = null;

    if ($user->hasRole('customer')) {
      $userIdFilter = $user->id;
    } else {
      Gate::authorize('viewAny', Order::class);
    }

    $orders = $this->orderService->findAll(
      paginate: true,
      perPage: $request->get('per_page', 5),
      page: $request->get('page', 1),
      userId: $userIdFilter
    );

    return OrderResource::collection($orders);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'checkout_id' => ['required', 'exists:checkouts,id'],
      'payment_method' => ['nullable', 'in:cod,card,paypal'],
    ]);
    $data['user_id'] = Auth::id();
    $order = $this->orderService->placeOrder($data);
    return new OrderResource($order->load('orderItems'));
  }

  public function show($id)
  {
    $order = $this->orderService->showOrder($id);
    Gate::authorize('view', $order);
    return new OrderResource($order->load('orderItems'));
  }

  public function update(Request $request, Order $order)
  {
    Gate::authorize('update', $order);

    $data = $request->validate([
      'status' => ['required', 'in:pending,completed,cancelled']
    ]);

    $order = $this->orderService->updateOrderStatus($order, $data);

    return new OrderResource($order->load('orderItems'));
  }

  public function destroy(Order $order)
  {
    Gate::authorize('delete', $order);

    $order = $this->orderService->cancelOrder($order);
    return new OrderResource($order->load('orderItems'));
  }
}
