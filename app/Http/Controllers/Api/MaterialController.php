<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\material\CreateMaterialRequest;
use App\Http\Requests\material\UpdateMaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Models\Material;
use App\Services\MaterialService;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
  public function __construct(
    private MaterialService $materialService
  ) {
    $this->authorizeResource(Material::class, 'material', [
      'except' => ['index']
    ]);
  }

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
    $material = $this->materialService->createMaterial($request->validated());
    return new MaterialResource($material);
  }

  public function show(Material $material)
  {
    return $material;
  }

  public function update(Material $material, UpdateMaterialRequest $request)
  {
    $newMaterial = $this->materialService->updateMaterial($material, $request->validated());
    return new MaterialResource($newMaterial);
  }
  public function destroy(Material $material)
  {
    $material = $this->materialService->deleteMaterial($material);
    return response()->json(['message' => 'Material deleted successfully']);
  }
}
