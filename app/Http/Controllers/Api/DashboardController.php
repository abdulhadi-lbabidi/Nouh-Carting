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

  public function index(): JsonResponse
  {

    Gate::authorize('viewStats', 'dashboard');
    $statistics = $this->dashboardService->getStatistics();

    return response()->json([
      'data'    => $statistics
    ], 200);
  }
}
