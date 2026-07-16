<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  public function __construct(
    private OrderService $orderService
  ) {}

  public function index(Request $request)
  {
    $orders = $this->orderService->findAll(
      paginate: true,
      perPage: $request->get('per_page', 5),
      page: $request->get('page', 1),
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

    if ($order->user_id !== Auth::id()) {
      abort(403, 'Unauthorized action.');
    }

    return new OrderResource($order->load('orderItems'));
  }

  public function update(Request $request, Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403, 'Unauthorized action.');
    }

    $data = $request->validate([
      'status' => ['required', 'in:pending,completed,cancelled']
    ]);

    $order = $this->orderService->updateOrderStatus($order, $data);

    return new OrderResource($order->load('orderItems'));
  }

  public function destroy(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403, 'Unauthorized action.');
    }

    $order = $this->orderService->cancelOrder($order);
    return new OrderResource($order->load('orderItems'));
  }
}
