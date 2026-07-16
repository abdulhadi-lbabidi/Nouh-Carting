<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $breakfastPack = Package::updateOrCreate(
      ['name->en' => 'Morning Fresh Package'],
      [
        'name' => [
          'ar' => 'باقة الصباح الطازج',
          'en' => 'Morning Fresh Package',
        ],
        'price' => 12.00,
      ]
    );

    $celebrationPack = Package::updateOrCreate(
      ['name->en' => 'Choco Lovers Package'],
      [
        'name' => [
          'ar' => 'باقة عشاق الشوكولاتة',
          'en' => 'Choco Lovers Package',
        ],
        'price' => 50.00,
      ]
    );


    $croissantVariant = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->where('products.name->en', 'French Butter Croissant')
      ->select('product_variants.*')
      ->first();

    $cakeVariant1Kg = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
      ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
      ->where('products.name->en', 'Premium Chocolate Cake')
      ->where('sizes.size', '1 Kg')
      ->select('product_variants.*')
      ->first();

    if ($breakfastPack && $croissantVariant) {
      $breakfastPack->variants()->sync([
        $croissantVariant->id => ['quantity' => 3]
      ]);
    }

    if ($celebrationPack && $cakeVariant1Kg && $croissantVariant) {
      $celebrationPack->variants()->sync([
        $cakeVariant1Kg->id => ['quantity' => 1],
        $croissantVariant->id => ['quantity' => 2]
      ]);
    }
  }
}
