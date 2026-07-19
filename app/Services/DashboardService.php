<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService
{
  public function getStatistics(): array
  {
    $today = Carbon::today();

    $totalProducts = Product::count();
    $totalCategories = Category::count();

    $newOrdersCount = Order::where('status', 'pending')->count();

    $todayOrdersCount = Order::whereDate('created_at', $today)->count();

    $totalSales = Order::where('status', 'completed')->sum('total_amount');

    $topSellingProducts = OrderItem::query()
      ->select('product_variant_id', DB::raw('SUM(quantity) as total_quantity_sold'))
      ->with([
        'productVariant.product',
        'productVariant.size',
        'productVariant.material'
      ])
      ->whereHas('order', function ($query) {
        $query->where('status', 'completed');
      })
      ->groupBy('product_variant_id')
      ->orderByDesc('total_quantity_sold')
      ->take(5)
      ->get();

    $lowStockVariants = ProductVariant::with(['product', 'size', 'material'])
      ->where('stock_quantity', '<=', 10)
      ->orderBy('stock_quantity', 'asc')
      ->take(5)
      ->get();

    $recentOrders = Order::with(['user'])
      ->latest()
      ->take(5)
      ->get();

    return [
      'overview' => [
        'total_products'     => $totalProducts,
        'total_categories'   => $totalCategories,
        'new_orders'         => $newOrdersCount,
        'today_orders'       => $todayOrdersCount,
        'total_sales'        => round($totalSales, 2),
      ],
      'top_selling_products' => $topSellingProducts->map(function ($item) {
        $variant = $item->productVariant;
        return [
          'variant_id'    => $item->product_variant_id,
          'product_name'  => $variant?->product?->translated_name,
          'size'          => $variant?->size?->size,
          'material'      => $variant?->material?->translated_material,
          'quantity_sold' => (int) $item->total_quantity_sold,
        ];
      }),
      'low_stock_variants' => $lowStockVariants->map(function ($variant) {
        return [
          'variant_id'     => $variant->id,
          'product_name'   => $variant->product?->translated_name,
          'size'           => $variant->size?->size,
          'material'       => $variant->material?->translated_material,
          'stock_quantity' => $variant->stock_quantity,
          'sku'            => $variant->sku,
        ];
      }),
      'recent_orders' => $recentOrders->map(function ($order) {
        return [
          'order_id'       => $order->id,
          'user_name'      => $order->user?->name ?? 'Guest',
          'total_amount'   => $order->total_amount,
          'payment_method' => $order->payment_method,
          'status'         => $order->status,
          'created_at'     => $order->created_at->format('Y-m-d H:i:s'),
        ];
      }),
    ];
  }
}