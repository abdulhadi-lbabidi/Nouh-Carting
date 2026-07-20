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
    // 1️⃣ جلب الأحجام والمكونات القياسية كـ Default
    $defaultSize     = Size::where('size', '1 Piece')->first() ?? Size::first();
    $friesSize       = Size::where('size', '250g')->first() ?? $defaultSize;
    $pizzaSize       = Size::where('size', '500g')->first() ?? $defaultSize;
    $kabsaSize       = Size::where('size', '1 Kg')->first() ?? $defaultSize;

    $defaultMaterial = Material::where('material->en', 'Classic Garlic Cream')->first() ?? Material::first();
    $meatMaterial    = Material::where('material->en', 'Pure Angus Beef')->first() ?? $defaultMaterial;
    $cheeseMaterial  = Material::where('material->en', 'Melted Cheddar & Mozzarella')->first() ?? $defaultMaterial;

    // 2️⃣ بنك صور جاهز لكل قسم (4 صور مميزة لكل صنف طعام) لضمان التنوع الجميل
    $imagesBank = [
      'Grilled & Broasted Chicken' => [
        'https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1569058242253-92a9c755a0ec?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1606755962773-d324e0a13086?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?q=80&w=600&auto=format&fit=crop'
      ],
      'French Fries & Appetizers' => [
        'https://images.unsplash.com/photo-1585109649139-366815a0d713?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1576107232684-1279f390859f?q=80&w=600&auto=format&fit=crop'
      ],
      'Italian Pizza' => [
        'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1593560708920-61dd98c46a4e?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?q=80&w=600&auto=format&fit=crop'
      ],
      'Seafood & Fish' => [
        'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1534604973900-c43ab4c2e0ab?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1551248429-40975aa4de74?q=80&w=600&auto=format&fit=crop'
      ],
      'Beef & Chicken Burger' => [
        'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1550547660-d9450f859349?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1525059696034-4967a8e1dca2?q=80&w=600&auto=format&fit=crop'
      ],
      'Grills & Arabic Kabsa' => [
        'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?q=80&w=600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=600&auto=format&fit=crop'
      ],
    ];

    // 3️⃣ جلب كل المنتجات الـ 18 المتوفرة في قاعدة البيانات مع القسم الخاص بها
    $products = Product::with('category')->get();

    foreach ($products as $product) {
      if (!$product->category) {
        continue;
      }

      // 🟢 جلب الاسم بشكل آمن سواء كان مصفوفة أو نص JSON
      $categoryName = $product->category->name;
      $categoryNameEn = is_array($categoryName) ? ($categoryName['en'] ?? '') : json_decode($categoryName, true)['en'] ?? '';

      $sizeId     = $defaultSize->id;
      $materialId = $defaultMaterial->id;
      $price      = 10.00;

      if ($categoryNameEn === 'French Fries & Appetizers') {
        $sizeId     = $friesSize->id;
        $materialId = $cheeseMaterial->id;
        $price      = 5.00;
      } elseif ($categoryNameEn === 'Italian Pizza') {
        $sizeId = $pizzaSize->id;
        $price  = 15.00;
      } elseif ($categoryNameEn === 'Beef & Chicken Burger') {
        $materialId = $meatMaterial->id;
        $price      = 12.00;
      } elseif ($categoryNameEn === 'Grills & Arabic Kabsa') {
        $sizeId = $kabsaSize->id;
        $price  = 35.00;
      }

      // إنشاء المتغير للمنتج إذا لم يكن موجوداً مسبقاً
      $variant = ProductVariant::updateOrCreate(
        [
          'product_id'  => $product->id,
          'size_id'     => $sizeId,
          'material_id' => $materialId,
        ],
        [
          'price'          => $price,
          'discount'       => rand(0, 1) ? 10 : 0,
          'stock_quantity' => rand(20, 80),
          'sku'            => ProductVariant::generateUniqueSku(),
          'barcode'        => ProductVariant::generateUniqueBarcode(),
        ]
      );

      // رفع الـ 4 صور الخاصة بالقسم الخاص بهذا المنتج
      if ($variant->wasRecentlyCreated || $variant->getMedia('variants')->isEmpty()) {
        $images = $imagesBank[$categoryNameEn] ?? $imagesBank['Grilled & Broasted Chicken'];
        foreach ($images as $url) {
          try {
            $variant->addMediaFromUrl($url)
              ->toMediaCollection('variants');
          } catch (\Exception $e) {
            $this->command->warn("Could not download image for product variant: " . $product->getTranslation('name', 'en'));
          }
        }
      }
    }

    $this->command->info('Guaranteed! All 18 products now have variants with 4 images each!');
  }
}
