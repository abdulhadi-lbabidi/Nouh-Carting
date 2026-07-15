<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
  public function registerUser(array $data)
  {
    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],

      'password' => Hash::make($data['password']),
    ]);
    $user->assignRole('customer');
    $token = $user->createToken('auth_token')->plainTextToken;
    return $token;
  }

  public function loginUser(array $data)
  {
    $user = User::where('email', $data['email'])->first();
    if (!$user || !Hash::check($data['password'], $user->password)) {
      return null;
    }

    if (!$user->is_active) {
      abort(403, 'هذا الحساب معطل، يرجى التواصل مع الإدارة.');
    }

    $user->tokens()->delete();
    $token = $user->createToken('auth_token')->plainTextToken;
    return $token;
  }

  public function updateProfile(User $user, array $data): User
  {
    if (!empty($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    } else {
      unset($data['password']);
    }

    $user->update($data);

    return $user;
  }
}
