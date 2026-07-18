<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\material\CreateMaterialRequest;
use App\Http\Requests\material\UpdateMaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Models\Material;
use App\Services\MaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MaterialController extends Controller
{
  public function __construct(
    private MaterialService $materialService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $materials = $this->materialService->findAll($paginate, $perPage, $page);

    return MaterialResource::collection($materials);
  }

  public function store(CreateMaterialRequest $request)
  {
    Gate::authorize('create', Material::class);

    $material = $this->materialService->createMaterial($request->validated());
    return new MaterialResource($material);
  }

  public function show(Material $material)
  {

    return new MaterialResource($material);
  }

  public function update(Material $material, UpdateMaterialRequest $request)
  {
    Gate::authorize('update', $material);

    $newMaterial = $this->materialService->updateMaterial($material, $request->validated());
    return new MaterialResource($newMaterial);
  }
  public function destroy(Material $material)
  {
    Gate::authorize('delete', $material);

    if ($material->productVariants()->exists()) {
      return response()->json([
        'message' => 'Cannot delete this material because it is currently linked to product variants. Remove or update those variants first.'
      ], 422);
    }
    $this->materialService->deleteMaterial($material);
    return response()->json([
      'message' => 'Material deleted successfully'
    ], 200);
  }
}
