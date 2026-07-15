<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CategoryController extends Controller
{
  public function __construct(
    private CategoryService $categoryService
  ) {}

  public function index(Request $request)
  {
    $paginate = $request->boolean('paginate', false);
    $perPage  = $request->input('per_page', 10);
    $page     = $request->input('page', 1);

    $categories = $this->categoryService->findAll($paginate, $perPage, $page);

    return CategoryResource::collection($categories);
  }

  public function store(CreateCategoryRequest $request)
  {
    Gate::authorize('create', Category::class);

    $validated = $request->validated();
    $category = $this->categoryService->createCategory(
      $validated,
      $request->file('images') ?? []
    );
    return new CategoryResource($category);
  }


  public function show(Category $category)
  {
    return new CategoryResource($category);
  }

  public function update(Category $category, UpdateCategoryRequest $request)
  {
    Gate::authorize('update', $category);

    $validated = $request->validated();

    $deletedMediaIds = $request->input('deleted_media_ids', []);

    $newCategory = $this->categoryService->updateCategory(
      $category,
      $validated,
      $request->file('images'),
      $deletedMediaIds
    );

    return new CategoryResource($newCategory);
  }

  public function destroy(Category $category)
  {
    Gate::authorize('delete', $category);

    $this->categoryService->deleteCategory($category);

    return response()->json([
      'message' => 'Deleted successfully'
    ], 200);
  }
}
