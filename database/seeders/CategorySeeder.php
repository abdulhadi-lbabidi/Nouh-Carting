<?php

namespace Database\Seeders;

use App\Models\Category;
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
          'ar' => 'فروج مشوي وبروستد',
          'en' => 'Grilled & Broasted Chicken',
        ],
        'description' => [
          'ar' => 'فروج مشوي على الفحم أو بروستد مقرمش ومتبل بخلطتنا السحرية يقدم مع الثوم والبطاطا.',
          'en' => 'Charcoal-grilled or crispy broasted chicken, marinated in our secret blend, served with garlic sauce and fries.',
        ],
        // 🟢 مصفوفة تحتوي على 3 صور للفروج والبروستد
        'image_urls' => [
          'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?q=80&w=600&auto=format&fit=crop',
        ],
      ],
      [
        'name' => [
          'ar' => 'بطاطا مقلية ومقبلات',
          'en' => 'French Fries & Appetizers',
        ],
        'description' => [
          'ar' => 'أصابع البطاطا المقرمشة الذهبية, بطاطا بالجبنة, وتشكيلة من المقبلات الساخنة اللذيذة.',
          'en' => 'Golden crispy french fries, cheesy fries, and a selection of delicious hot appetizers.',
        ],
        // 🟢 مصفوفة تحتوي على 3 صور للبطاطا والمقبلات
        'image_urls' => [
          'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1585109649139-366815a0d713?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=600&auto=format&fit=crop', 
        ],
      ],
      [
        'name' => [
          'ar' => 'بيتزا إيطالية',
          'en' => 'Italian Pizza',
        ],
        'description' => [
          'ar' => 'بيتزا مخبوزة على الحجر بعجينة إيطالية رقيقة وغنية بأجود أنواع جبن الموزاريلا والمكونات الطازجة.',
          'en' => 'Stone-baked pizza made with thin Italian dough, loaded with premium mozzarella and fresh toppings.',
        ],
        // 🟢 مصفوفة تحتوي على 3 صور للبيتزا
        'image_urls' => [
          'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1593560708920-61dd98c46a4e?q=80&w=600&auto=format&fit=crop',
        ],
      ],
      [
        'name' => [
          'ar' => 'مأكولات بحرية وسمك',
          'en' => 'Seafood & Fish',
        ],
        'description' => [
          'ar' => 'أصناف متنوعة من السمك الطازج المشوي والمقلي، والروبيان المقرمش مع الأرز الصيادية والصلصات الخاصة.',
          'en' => 'A variety of fresh grilled and fried fish, crispy shrimp served with Sayadiya rice and custom sauces.',
        ],
        // 🟢 مصفوفة تحتوي على 3 صور للمأكولات البحرية
        'image_urls' => [
          'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1534604973900-c43ab4c2e0ab?q=80&w=600&auto=format&fit=crop',
        ],
      ],
      [
        'name' => [
          'ar' => 'برجر لحم ودجاج',
          'en' => 'Beef & Chicken Burger',
        ],
        'description' => [
          'ar' => 'قطع البرجر المحضرة يومياً من اللحم البقري الصافي أو الدجاج المقرمش مع الجبنة الذائبة في خبز البريوش.',
          'en' => 'Daily prepared pure beef patties or crispy chicken fillets with melted cheese in soft brioche buns.',
        ],
        // 🟢 مصفوفة تحتوي على 3 صور للبرجر
        'image_urls' => [
          'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1550547660-d9450f859349?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?q=80&w=600&auto=format&fit=crop',
        ],
      ],
      [
        'name' => [
          'ar' => 'مشويات وكبسة عربية',
          'en' => 'Grills & Arabic Kabsa',
        ],
        'description' => [
          'ar' => 'أطباق الكبسة العريقة بالأرز البسمتي طويل الحبة مع قطع اللحم أو الدجاج المطهو ببطء والمشويات الشرقية.',
          'en' => 'Traditional Kabsa dishes with long-grain basmati rice, slow-cooked meat or chicken, and authentic oriental grills.',
        ],
        // 🟢 مصفوفة تحتوي على 3 صور للمشويات والكبسة
        'image_urls' => [
          'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?q=80&w=600&auto=format&fit=crop',
        ],
      ],
    ];

    foreach ($categories as $categoryData) {
      $category = Category::updateOrCreate(
        ['name->ar' => $categoryData['name']['ar']],
        [
          'name' => $categoryData['name'],
          'description' => $categoryData['description'],
        ]
      );

      // 🟢 الجوهر: الدوران حول الروابط المتعددة لرفعها كلها في كوليكشن categories
      if ($category->wasRecentlyCreated || $category->getMedia('categories')->isEmpty()) {
        foreach ($categoryData['image_urls'] as $url) {
          try {
            $category->addMediaFromUrl($url)
              ->toMediaCollection('categories');
          } catch (\Exception $e) {
            $this->command->warn("Could not download image for category: " . $categoryData['name']['en'] . " from URL: " . $url);
          }
        }
      }
    }
  }
}