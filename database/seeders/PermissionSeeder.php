<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $resources = [
      'dashboard' => [
        'ar' => 'لوحة التحكم',
        'en' => 'Dashboard',
      ],

      'category' => [
        'ar' => 'الأقسام',
        'en' => 'Categories',
      ],
      'product' => [
        'ar' => 'المنتجات',
        'en' => 'Products',
      ],
      'product_variant' => [
        'ar' => 'متغيرات المنتجات',
        'en' => 'Product Variants',
      ],
      'material' => [
        'ar' => 'المواد',
        'en' => 'Materials',
      ],
      'size' => [
        'ar' => 'المقاسات',
        'en' => 'Sizes',
      ],
      'package' => [
        'ar' => 'الباقات',
        'en' => 'Packages',
      ],
      'user' => [
        'ar' => 'المستخدمين',
        'en' => 'Users',
      ],
      'review' => [
        'ar' => 'التقييمات',
        'en' => 'Reviews',
      ],
      'wishlist' => [
        'ar' => 'قائمة الأمنيات',
        'en' => 'Wishlists',
      ],

      'role' => [
        'ar' => 'الأدوار',
        'en' => 'Roles',
      ],
      'permission' => [
        'ar' => 'الصلاحيات',
        'en' => 'Permissions',
      ],
      'order' => [
        'ar' => 'الطلبات',
        'en' => 'Orders',
      ],
      'checkout' => [
        'ar' => 'عمليات الدفع',
        'en' => 'Checkouts',
      ],
    ];

    $actions = [
      'view'   => [
        'ar' => 'عرض',
        'en' => 'View',
      ],
      'create' => [
        'ar' => 'إضافة',
        'en' => 'Create',
      ],
      'update' => [
        'ar' => 'تعديل',
        'en' => 'Edit',
      ],
      'delete' => [
        'ar' => 'حذف',
        'en' => 'Delete',
      ],

    ];

    $guardName = 'api';

    foreach ($resources as $resource => $resourceTranslations) {
      foreach ($actions as $action => $actionTranslations) {

        if ($resource === 'dashboard' && $action !== 'view') {
          continue;
        }

        $permissionName = "{$action}_{$resource}";

        $displayName = [
          'ar' => "{$actionTranslations['ar']} {$resourceTranslations['ar']}",
          'en' => "{$actionTranslations['en']} {$resourceTranslations['en']}",
        ];

        Permission::updateOrCreate(
          [
            'name' => $permissionName,
            'guard_name' => $guardName,
          ],
          [
            'display_name' => $displayName,
          ]
        );
      }
    }
  }
}
