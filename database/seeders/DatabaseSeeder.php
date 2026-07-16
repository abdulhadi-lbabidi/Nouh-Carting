<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    Role::findOrCreate('customer', 'api');

    $this->call([
      PermissionSeeder::class,
      AdminSeeder::class,
      CategorySeeder::class,
      ProductSeeder::class,
      SizeSeeder::class,
      MaterialSeeder::class,
      ProductVariantSeeder::class,
      PackageSeeder::class,
    ]);
  }
}
