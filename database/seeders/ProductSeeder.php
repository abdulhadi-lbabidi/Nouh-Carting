<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $bakeryCategory   = Category::where('name->en', 'Fresh Bakery')->first();
    $cakesCategory    = Category::where('name->en', 'Cakes & Tarts')->first();
    $snacksCategory   = Category::where('name->en', 'Snacks & Appetizers')->first();
    $sandwichCategory = Category::where('name->en', 'Sandwiches & Light Meals')->first();
    $cookiesCategory  = Category::where('name->en', 'Cookies & Biscuits')->first();

    $products = [
      [
        'category_id' => $bakeryCategory?->id,
        'name' => [
          'ar' => 'كرواسان بالزبدة الفرنسية',
          'en' => 'French Butter Croissant',
        ],
        'body' => [
          'ar' => 'كرواسان هش ومقرمش محضر بأجود أنواع الزبدة الفرنسية الطبيعية.',
          'en' => 'Flaky and crispy croissant prepared with the finest natural French butter.',
        ],
        'is_featured' => true,
      ],
      [
        'category_id' => $bakeryCategory?->id,
        'name' => [
          'ar' => 'خبز التوست بالحبوب الكاملة',
          'en' => 'Whole Grain Toast',
        ],
        'body' => [
          'ar' => 'خبز توست صحي غني بالألياف والحبوب الكاملة المغذية.',
          'en' => 'Healthy toast bread rich in dietary fiber and nutritious whole grains.',
        ],
        'is_featured' => false,
      ],

      [
        'category_id' => $cakesCategory?->id,
        'name' => [
          'ar' => 'كيك الشوكولاتة الفاخرة',
          'en' => 'Premium Chocolate Cake',
        ],
        'body' => [
          'ar' => 'قالب كيك غني بالشوكولاتة البلجيكية الداكنة مع طبقات الكريمة الناعمة.',
          'en' => 'Rich Belgian dark chocolate cake layered with smooth chocolate cream.',
        ],
        'is_featured' => true,
      ],
      [
        'category_id' => $cakesCategory?->id,
        'name' => [
          'ar' => 'تارت الفراولة الطازجة',
          'en' => 'Fresh Strawberry Tart',
        ],
        'body' => [
          'ar' => 'عجينة تارت مقرمشة محشوة بكريمة الباستري اللذيذة ومغطاة بالفراولة الطازجة.',
          'en' => 'Crispy tart crust filled with delicious pastry cream and topped with fresh strawberries.',
        ],
        'is_featured' => false,
      ],

      [
        'category_id' => $snacksCategory?->id,
        'name' => [
          'ar' => 'معجنات الجبنة والزعتر المشكلة',
          'en' => 'Assorted Cheese & Thyme Pastries',
        ],
        'body' => [
          'ar' => 'تشكيلة من الفطائر الصغيرة المحشوة بالأجبان الفاخرة والزعتر البلدي.',
          'en' => 'A selection of mini pastries filled with premium cheeses and local thyme.',
        ],
        'is_featured' => false,
      ],

      [
        'category_id' => $sandwichCategory?->id,
        'name' => [
          'ar' => 'كلوب ساندويش الدجاج المدخن',
          'en' => 'Smoked Chicken Club Sandwich',
        ],
        'body' => [
          'ar' => 'شرائح صدر الدجاج المدخن مع الجبن، الخس، الطماطم والمايونيز في خبز التوست الخاص بنا.',
          'en' => 'Smoked chicken breast slices with cheese, lettuce, tomato, and mayo in our special toasted bread.',
        ],
        'is_featured' => true,
      ],

      [
        'category_id' => $cookiesCategory?->id,
        'name' => [
          'ar' => 'كوكيز الشوكولاتة المزدوجة',
          'en' => 'Double Chocolate Cookies',
        ],
        'body' => [
          'ar' => 'كوكيز غنية ومخبوزة بقطع الشوكولاتة الداكنة والحليبية المقرمشة.',
          'en' => 'Rich baked cookies loaded with dark and milk chocolate chunks.',
        ],
        'is_featured' => true,
      ],
    ];

    foreach ($products as $productData) {
      if ($productData['category_id']) {
        Product::updateOrCreate(
          ['name->en' => $productData['name']['en']], 
          [
            'category_id' => $productData['category_id'],
            'name' => $productData['name'],
            'body' => $productData['body'],
            'is_featured' => $productData['is_featured'],
          ]
        );
      }
    }

    $this->command->info('Products seeded successfully without images!');
  }
}