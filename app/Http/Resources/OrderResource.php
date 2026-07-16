<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'total_amount' => $this->total_amount,
      'shipping_fee' => $this->shipping_fee,
      'delivery_fee' => $this->delivery_fee,
      'payment_method' => $this->payment_method,
      'status' => $this->status,
      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

      'shipping_details' => $this->checkout ? [
        'first_name' => $this->checkout->first_name,
        'last_name' => $this->checkout->last_name,
        'phone' => $this->checkout->phone,
        'email' => $this->checkout->email,
        'country' => $this->checkout->country,
        'city' => $this->checkout->city,
        'street' => $this->checkout->street,
      ] : null,

      'items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
    ];
  }
}
