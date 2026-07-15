<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $guardName = 'api';

    $adminRole = Role::firstOrCreate([
      'name' => 'admin',
      'guard_name' => $guardName
    ]);

    $allPermissions = Permission::where('guard_name', $guardName)->get();

    $adminRole->syncPermissions($allPermissions);

    $adminUser = User::updateOrCreate(
      [
        'email' => 'admin@gmail.com',
      ],
      [
        'name' => 'Admin',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
      ]
    );

    $adminUser->assignRole($adminRole);
  }
}