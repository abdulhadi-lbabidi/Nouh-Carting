<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
  public function __construct(
    private DashboardService $dashboardService
  ) {}

  public function index(Request $request): JsonResponse
  {
    Gate::authorize('viewStats', 'dashboard');

    $month = $request->input('month');
    $year = $request->input('year');

    $statistics = $this->dashboardService->getStatistics($month, $year);

    return response()->json([
      'data' => $statistics
    ], 200);
  }
}