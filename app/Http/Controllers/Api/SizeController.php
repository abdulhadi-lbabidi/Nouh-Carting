<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Size\CreateSizeRequest;
use App\Http\Requests\Size\UpdateSizeRequest;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use App\Services\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
  public function __construct(
    private SizeService $sizeService
  ) {
    $this->authorizeResource(Size::class, 'size', [
      'except' => ['index']
    ]);
  }
  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $sizes = $this->sizeService->findAll($paginate, $perPage, $page);

    return SizeResource::collection($sizes);
  }
  public function store(CreateSizeRequest $request)
  {
    $size = $this->sizeService->createSize($request->validated());
    return new SizeResource($size);
  }

  public function show(Size $size)
  {
    return $size;
  }

  public function update(Size $size, UpdateSizeRequest $request)
  {
    $newSize = $this->sizeService->updateSize($size, $request->validated());
    return new SizeResource($newSize);
  }
  public function destroy(Size $size)
  {
    $size = $this->sizeService->deleteSize($size);
    return response()->json(['message' => 'Size deleted successfully']);
  }
}
