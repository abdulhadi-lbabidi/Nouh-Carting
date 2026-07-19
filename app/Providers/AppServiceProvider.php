<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Role;
use App\Models\Size;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\MaterialPolicy;
use App\Policies\PackagePolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProductVariantPolicy;
use App\Policies\RolePolicy;
use App\Policies\SizePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies\DashboardPolicy;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Gate::policy(Category::class, CategoryPolicy::class);
    Gate::policy(Material::class, MaterialPolicy::class);
    Gate::policy(Package::class, PackagePolicy::class);
    Gate::policy(Product::class, ProductPolicy::class);
    Gate::policy(ProductVariant::class, ProductVariantPolicy::class);
    Gate::policy(Role::class, RolePolicy::class);
    Gate::policy(Size::class, SizePolicy::class);
    Gate::policy(User::class, UserPolicy::class);

    Gate::define('viewStats', [DashboardPolicy::class, 'viewStats']);
  }
}
