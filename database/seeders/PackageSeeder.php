<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // 🟢 1. إنشاء العروض الـ 6 الجديدة وأسعارها
    $combo1 = Package::updateOrCreate(
      ['name->en' => 'Super Charcoal Box'],
      [
        'name' => [
          'ar' => 'صندوق الفروج المشوي الخارق',
          'en' => 'Super Charcoal Box',
        ],
        'price' => 25.00,
      ]
    );

    $combo2 = Package::updateOrCreate(
      ['name->en' => 'Crunchy Broasted Combo'],
      [
        'name' => [
          'ar' => 'كومبو البروستد المقرمش التوفيري',
          'en' => 'Crunchy Broasted Combo',
        ],
        'price' => 18.00,
      ]
    );

    $combo3 = Package::updateOrCreate(
      ['name->en' => 'Weekend Grills Feast'],
      [
        'name' => [
          'ar' => 'وليمة المشويات العائلية لعطلة الأسبوع',
          'en' => 'Weekend Grills Feast',
        ],
        'price' => 60.00,
      ]
    );

    $combo4 = Package::updateOrCreate(
      ['name->en' => 'Pizza & Fries Party Pack'],
      [
        'name' => [
          'ar' => 'باقة الحفلات (بيتزا وبطاطا بالجبنة)',
          'en' => 'Pizza & Fries Party Pack',
        ],
        'price' => 22.00,
      ]
    );

    $combo5 = Package::updateOrCreate(
      ['name->en' => 'Double Burger & Appetizers Meal'],
      [
        'name' => [
          'ar' => 'وجبة البرجر المزدوج مع المقبلات',
          'en' => 'Double Burger & Appetizers Meal',
        ],
        'price' => 15.00,
      ]
    );

    $combo6 = Package::updateOrCreate(
      ['name->en' => 'Royal Lamb Kabsa Feast'],
      [
        'name' => [
          'ar' => 'الوليمة الملكية لكبسة لحم الغنم',
          'en' => 'Royal Lamb Kabsa Feast',
        ],
        'price' => 45.00,
      ]
    );

    $charcoalChickenVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'Charcoal Grilled Chicken')
      ->select('product_variants.*')
      ->first();

    $broastedChickenVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'Crispy Broasted Chicken Meal')
      ->select('product_variants.*')
      ->first();

    $loadedFriesVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'Loaded Cheesy Fries with Bacon')
      ->select('product_variants.*')
      ->first();

    $bbqPizzaVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'BBQ Chicken Pizza')
      ->select('product_variants.*')
      ->first();

    $doubleBurgerVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'Double Classic Cheeseburger')
      ->select('product_variants.*')
      ->first();

    $lambKabsaVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'Premium Lamb Kabsa Meal')
      ->select('product_variants.*')
      ->first();

    $mixGrillsVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'Assorted Mix Oriental Grills')
      ->select('product_variants.*')
      ->first();

    $onionRingsVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'Crispy Onion Rings')
      ->select('product_variants.*')
      ->first();

    if ($combo1 && $charcoalChickenVariant && $loadedFriesVariant) {
      $combo1->variants()->sync([
        $charcoalChickenVariant->id => ['quantity' => 1],
        $loadedFriesVariant->id     => ['quantity' => 1]
      ]);
    }

    if ($combo2 && $broastedChickenVariant && $onionRingsVariant) {
      $combo2->variants()->sync([
        $broastedChickenVariant->id => ['quantity' => 1],
        $onionRingsVariant->id      => ['quantity' => 1]
      ]);
    }

    if ($combo3 && $mixGrillsVariant && $loadedFriesVariant) {
      $combo3->variants()->sync([
        $mixGrillsVariant->id   => ['quantity' => 3],
        $loadedFriesVariant->id => ['quantity' => 2]
      ]);
    }

    if ($combo4 && $bbqPizzaVariant && $loadedFriesVariant) {
      $combo4->variants()->sync([
        $bbqPizzaVariant->id    => ['quantity' => 1],
        $loadedFriesVariant->id => ['quantity' => 1]
      ]);
    }

    if ($combo5 && $doubleBurgerVariant && $onionRingsVariant) {
      $combo5->variants()->sync([
        $doubleBurgerVariant->id => ['quantity' => 1],
        $onionRingsVariant->id   => ['quantity' => 1]
      ]);
    }

    if ($combo6 && $lambKabsaVariant) {
      $combo6->variants()->sync([
        $lambKabsaVariant->id => ['quantity' => 1]
      ]);
    }

    $this->command->info('6 Restaurant Packages seeded successfully!');
  }
}
