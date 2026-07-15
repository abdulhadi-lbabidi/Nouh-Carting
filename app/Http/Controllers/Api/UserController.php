<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function __construct(
    private UserService $userService
  ) {
    $this->authorizeResource(User::class, 'user');
  }

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $users = $this->userService->findAll($paginate, $perPage, $page);

    return UserResource::collection($users);
  }

  public function store(CreateUserRequest $request)
  {
    $validated = $request->validated();

    $user = $this->userService->createUser($validated);

    return new UserResource($user);
  }

  public function show(User $user)
  {
    $userWithRelations = $this->userService->findOne($user);

    return new UserResource($userWithRelations);
  }

  public function update(User $user, UpdateUserRequest $request)
  {
    $validated = $request->validated();

    $updatedUser = $this->userService->updateUser($user, $validated);

    return new UserResource($updatedUser);
  }

  public function destroy(User $user)
  {
    $this->userService->deleteUser($user);

    return response()->json([
      'message' => 'Deleted successfully'
    ], 200);
  }
}
