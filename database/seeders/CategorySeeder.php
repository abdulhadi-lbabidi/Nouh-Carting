<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      [
        'name' => [
          'ar' => 'مخبوزات طازجة',
          'en' => 'Fresh Bakery',
        ],
        'description' => [
          'ar' => 'تشكيلة يومية من الخبز الساخن، الكرواسان، والتوست الطازج مباشرة من أفراننا.',
          'en' => 'A daily selection of hot bread, croissants, and fresh toast straight from our ovens.',
        ],
      ],
      [
        'name' => [
          'ar' => 'حلويات كيك وتارت',
          'en' => 'Cakes & Tarts',
        ],
        'description' => [
          'ar' => 'قوالب كيك فاخرة، تارت الفواكه، وتشكيلة حلويات مناسبة لكل احتفالاتكم ومناسباتكم السعيدة.',
          'en' => 'Premium cakes, fruit tarts, and a sweet assortment perfect for all your happy celebrations.',
        ],
      ],
      [
        'name' => [
          'ar' => 'وجبات خفيفة ومقبلات',
          'en' => 'Snacks & Appetizers',
        ],
        'description' => [
          'ar' => 'فطائر صغيرة، معجنات محشية، ومقبلات شهية وخفيفة تناسب فترات الاستراحة والمشاركة مع الأصدقاء.',
          'en' => 'Mini pies, stuffed pastries, and delicious light appetizers perfect for breaks and sharing.',
        ],
      ],
      [
        'name' => [
          'ar' => 'سندويشات ومأكولات خفيفة',
          'en' => 'Sandwiches & Light Meals',
        ],
        'description' => [
          'ar' => 'سندويشات طازجة محضرة بأجود المكونات والخضار مع الصلصات المميزة والخبز الخاص بنا.',
          'en' => 'Freshly prepared sandwiches made with the finest ingredients, crisp veggies, and custom sauces on our baked bread.',
        ],
      ],
      [
        'name' => [
          'ar' => 'بسكويت وكوكيز',
          'en' => 'Cookies & Biscuits',
        ],
        'description' => [
          'ar' => 'بسكويت مقرمش، كوكيز غنية بقطع الشوكولاتة، وبيتي فور يذوب بالفم لتكتمل به أوقات الشاي والقهوة.',
          'en' => 'Crispy biscuits, rich chocolate chip cookies, and melt-in-your-mouth petit fours to complete your tea and coffee times.',
        ],
      ],
    ];

    foreach ($categories as $categoryData) {
      Category::updateOrCreate(
        ['name->ar' => $categoryData['name']['ar']],
        [
          'name' => $categoryData['name'],
          'description' => $categoryData['description'],
        ]
      );
    }
  }
}
