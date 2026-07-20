<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $sizes = [
      ['size' => '1 Piece'],
      ['size' => '4 Pieces'],
      ['size' => '250g'],
      ['size' => '500g'],
      ['size' => '1 Kg']
    ];

    foreach ($sizes as $size) {
      Size::firstOrCreate($size);
    }
  }
}
