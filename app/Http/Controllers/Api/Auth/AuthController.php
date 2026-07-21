<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function __construct(
    private AuthService $authService
  ) {}
  public function register(CreateUserRequest $request)
  {
    $token = $this->authService->registerUser($request->validated());
    $user = auth()->user() ?? User::where('email', $request->email)->first();
    $user->loadMissing(['roles', 'activeCart']);
    return response()->json([
      'token'   => $token,
      'user'    => new UserResource($user)
    ], 201);
  }

  public function login(LoginRequest $request)
  {
    $token = $this->authService->loginUser($request->validated());

    if (!$token) {
      return response()->json([
        'message' => 'Invalid email or password',
      ], 401);
    }
    $user = User::where('email', $request->email)->first();
    $user->loadMissing(['roles', 'activeCart']);

    return response()->json([
      'token'   => $token,
      'user'    => new UserResource($user)
    ]);
  }

  public function me()
  {
    $user = Auth::user();

    $user->loadMissing(['roles', 'activeCart']);
    return new UserResource($user);
  }

  public function updateProfile(UpdateProfileRequest $request)
  {
    $user = $this->authService->updateProfile(
      Auth::user(),
      $request->validated()
    );
    return response()->json([
      'message' => 'Profile updated successfully',
      'user' => $user,
    ]);
  }

  public function logout()
  {
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if ($user) {
      $user->currentAccessToken()->delete();
    }

    return response()->json([
      'message' => 'Logged out successfully',
    ], 200);
  }
}
