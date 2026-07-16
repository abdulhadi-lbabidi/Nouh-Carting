<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
          'ar' => 'شوكولاتة بلجيكية فاخرة',
          'en' => 'Premium Belgian Chocolate',
        ]
      ],
      [
        'material' => [
          'ar' => 'طحين بر عضوي كامل',
          'en' => 'Organic Whole Wheat Flour',
        ]
      ],
      [
        'material' => [
          'ar' => 'مكسرات مشكلة محمصة',
          'en' => 'Assorted Roasted Nuts',
        ]
      ],
      [
        'material' => [
          'ar' => 'عجينة الزبدة الفرنسية الطبيعية',
          'en' => 'Natural French Butter Dough',
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
