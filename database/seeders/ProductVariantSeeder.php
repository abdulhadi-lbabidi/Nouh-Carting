<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Material;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // 1️⃣ جلب الأحجام الجديدة
    $size1Piece  = Size::where('size', '1 Piece')->first();
    $size4Pieces = Size::where('size', '4 Pieces')->first();
    $size250g    = Size::where('size', '250g')->first();
    $size500g    = Size::where('size', '500g')->first();
    $size1Kg     = Size::where('size', '1 Kg')->first();

    // 2️⃣ جلب المكونات الجديدة
    $angusBeef   = Material::where('material->en', 'Pure Angus Beef')->first();
    $spicyBlend  = Material::where('material->en', 'Spicy Seasoning Blend')->first();
    $bbqSauce    = Material::where('material->en', 'Smoked BBQ Sauce')->first();
    $garlicCream = Material::where('material->en', 'Classic Garlic Cream')->first();
    $cheeseMelt  = Material::where('material->en', 'Melted Cheddar & Mozzarella')->first();

    // 3️⃣ جلب المنتجات الأساسية
    $charcoalChicken = Product::where('name->en', 'Charcoal Grilled Chicken')->first();
    $broastedChicken = Product::where('name->en', 'Crispy Broasted Chicken Meal')->first();
    $loadedFries     = Product::where('name->en', 'Loaded Cheesy Fries with Bacon')->first();
    $bbqPizza        = Product::where('name->en', 'BBQ Chicken Pizza')->first();
    $doubleBurger    = Product::where('name->en', 'Double Classic Cheeseburger')->first();
    $lambKabsa       = Product::where('name->en', 'Premium Lamb Kabsa Meal')->first();

    $variants = [];

    // 🔥 1. بروستد مقرمش (4 قطع حار) - 4 صور متنوعة
    if ($broastedChicken && $size4Pieces && $spicyBlend) {
      $variants[] = [
        'product_id' => $broastedChicken->id,
        'size_id' => $size4Pieces->id,
        'material_id' => $spicyBlend->id,
        'price' => 8.50,
        'discount' => 5,
        'stock_quantity' => 40,
        'images' => [
          'https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1569058242253-92a9c755a0ec?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1606755962773-d324e0a13086?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1541518763669-27fef04b14ea?q=80&w=600&auto=format&fit=crop'
        ]
      ];
    }

    // 🔥 2. بطاطا مقرمشة بالجبنة (250 غرام) - 4 صور متنوعة
    // 🔥 2. بطاطا مقرمشة بالجبنة (250 غرام)
    if ($loadedFries && $size250g && $cheeseMelt) {
      $variants[] = [
        'product_id' => $loadedFries->id,
        'size_id' => $size250g->id,
        'material_id' => $cheeseMelt->id,
        'price' => 4.00,
        'discount' => 0,
        'stock_quantity' => 100,
        'images' => [
          'https://images.unsplash.com/photo-1585109649139-366815a0d713?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1576107232684-1279f390859f?q=80&w=600&auto=format&fit=crop'
        ]
      ];
    }

    // 🔥 5. كبسة لحم غنم فاخرة (1 كيلو) - تحديث الرابط الرابع
    if ($lambKabsa && $size1Kg && $spicyBlend) {
      $variants[] = [
        'product_id' => $lambKabsa->id,
        'size_id' => $size1Kg->id,
        'material_id' => $spicyBlend->id,
        'price' => 40.00,
        'discount' => 15,
        'stock_quantity' => 20,
        'images' => [
          'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=600&auto=format&fit=crop' 
        ]
      ];
    }

    // 🔥 3. بيتزا باربكيو (500 غرام) - 4 صور متنوعة
    if ($bbqPizza && $size500g && $bbqSauce) {
      $variants[] = [
        'product_id' => $bbqPizza->id,
        'size_id' => $size500g->id,
        'material_id' => $bbqSauce->id,
        'price' => 14.00,
        'discount' => 10,
        'stock_quantity' => 30,
        'images' => [
          'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1593560708920-61dd98c46a4e?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?q=80&w=600&auto=format&fit=crop'
        ]
      ];
    }

    // 🔥 4. برجر دبل تشيز أنجوس (1 قطعة) - 4 صور متنوعة
    if ($doubleBurger && $size1Piece && $angusBeef) {
      $variants[] = [
        'product_id' => $doubleBurger->id,
        'size_id' => $size1Piece->id,
        'material_id' => $angusBeef->id,
        'price' => 11.00,
        'discount' => 0,
        'stock_quantity' => 60,
        'images' => [
          'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1550547660-d9450f859349?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?q=80&w=600&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1525059696034-4967a8e1dca2?q=80&w=600&auto=format&fit=crop'
        ]
      ];
    }



    // 4️⃣ حفظ وإدخال المتغيرات مع رفع الصور الأربعة المتعددة
    foreach ($variants as $variantData) {
      $imageUrls = $variantData['images'];
      unset($variantData['images']); // إزالة مصفوفة الصور قبل الإدخال في قاعدة البيانات

      // فحص عدم التكرار
      $variant = ProductVariant::where('product_id', $variantData['product_id'])
        ->where('size_id', $variantData['size_id'])
        ->where('material_id', $variantData['material_id'])
        ->first();

      if (!$variant) {
        $variant = ProductVariant::create(array_merge($variantData, [
          'sku' => ProductVariant::generateUniqueSku(),
          'barcode' => ProductVariant::generateUniqueBarcode(),
        ]));
      }

      // 🟢 الجوهر: رفع 4 صور للمتغير الحالي عبر الكوليكشن 'variants'
      if ($variant->getMedia('variants')->isEmpty()) {
        foreach ($imageUrls as $url) {
          try {
            $variant->addMediaFromUrl($url)
              ->toMediaCollection('variants'); // تم اعتماد اسم الكوليكشن 'variants'
          } catch (\Exception $e) {
            $this->command->warn("Could not download variant image: " . $url);
          }
        }
      }
    }

    $this->command->info('Product Variants seeded successfully with 4 images per variant!');
  }
}
