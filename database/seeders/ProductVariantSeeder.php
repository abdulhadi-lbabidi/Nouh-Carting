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
    $size1Kg  = Size::where('size', '1 Kg')->first();
    $size500g = Size::where('size', '500g')->first();
    $sizeSingle = Size::where('size', 'Single Portion')->first();

    $belgianChoc = Material::where('material->en', 'Premium Belgian Chocolate')->first();
    $butterDough = Material::where('material->en', 'Natural French Butter Dough')->first();

    $croissant = Product::where('name->en', 'French Butter Croissant')->first();
    $cake      = Product::where('name->en', 'Premium Chocolate Cake')->first();

    $variants = [];

    if ($croissant && $sizeSingle && $butterDough) {
      $variants[] = [
        'product_id' => $croissant->id,
        'size_id' => $sizeSingle->id,
        'material_id' => $butterDough->id,
        'price' => 4.00,
        'discount' => 0,
        'stock_quantity' => 100,
      ];
    }

    if ($cake && $size1Kg && $belgianChoc) {
      $variants[] = [
        'product_id' => $cake->id,
        'size_id' => $size1Kg->id,
        'material_id' => $belgianChoc->id,
        'price' => 35.00,
        'discount' => 10, 
        'stock_quantity' => 15,
      ];
    }

    if ($cake && $size500g && $belgianChoc) {
      $variants[] = [
        'product_id' => $cake->id,
        'size_id' => $size500g->id,
        'material_id' => $belgianChoc->id,
        'price' => 20.00,
        'discount' => 0,
        'stock_quantity' => 25,
      ];
    }

    foreach ($variants as $variantData) {
      $exists = ProductVariant::where('product_id', $variantData['product_id'])
        ->where('size_id', $variantData['size_id'])
        ->where('material_id', $variantData['material_id'])
        ->exists();

      if (!$exists) {
        ProductVariant::create(array_merge($variantData, [
          'sku' => ProductVariant::generateUniqueSku(),
          'barcode' => ProductVariant::generateUniqueBarcode(),
        ]));
      }
    }

    $this->command->info('Product Variants seeded successfully!');
  }
}
