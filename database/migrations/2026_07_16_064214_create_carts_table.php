<?php

use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('carts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->string('status')->default('active');
      $table->timestamps();
    });

    Schema::create('cart_items', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Cart::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(ProductVariant::class)->constrained()->cascadeOnDelete();
      $table->integer('quantity')->default(1);
      $table->timestamps();

      $table->unique(['cart_id', 'product_variant_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cart_items');
    Schema::dropIfExists('carts');
  }
};
