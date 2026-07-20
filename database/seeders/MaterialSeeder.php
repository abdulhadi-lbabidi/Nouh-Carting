<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $materials = [
      [
        'material' => [
          'ar' => 'لحم بقري أنجوس صافي',
          'en' => 'Pure Angus Beef',
        ]
      ],
      [
        'material' => [
          'ar' => 'خلطة بهارات حارة (سبايسي)',
          'en' => 'Spicy Seasoning Blend',
        ]
      ],
      [
        'material' => [
          'ar' => 'صوص باربكيو مدخن',
          'en' => 'Smoked BBQ Sauce',
        ]
      ],
      [
        'material' => [
          'ar' => 'كريم ثوم كلاسيك وعادي',
          'en' => 'Classic Garlic Cream',
        ]
      ],
      [
        'material' => [
          'ar' => 'جبنة شيدر وموزاريلا ذائبة',
          'en' => 'Melted Cheddar & Mozzarella',
        ]
      ],
    ];

    foreach ($materials as $materialData) {
      Material::updateOrCreate(
        ['material->en' => $materialData['material']['en']],
        ['material' => $materialData['material']]
      );
    }
  }
}
