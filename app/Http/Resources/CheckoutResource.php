<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'email' => $this->email,
      'phone' => $this->phone,
      'country' => $this->country,
      'city' => $this->city,
      'street' => $this->street,
      'floor' => $this->floor,
      'postal_code' => $this->postal_code,
      'additional_information' => $this->additional_information,
      'status' => $this->status,
      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

      'user' => $this->user ? [
        'id' => $this->user->id,
        'name' => $this->user->name,
        'email' => $this->user->email,
      ] : null,

      'cart' => $this->cart ? [
        'id' => $this->cart->id,
        'status' => $this->cart->status,
        'items'  => CartItemResource::collection($this->cart->cartItems),
      ] : null,
    ];
  }
}
