<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('unit_type');
            $table->decimal('price',8,2);
            $table->decimal('discount_percentage',8,2);
            $table->decimal('discount_price',8,2);
            $table->datetime('discount_from')->nullable();
            $table->datetime('discount_to')->nullable();
            $table->decimal('taxable_percentage',8,2);
            $table->decimal('taxable_amount',8,2);
            $table->tinyInteger('in_stock')->default(1);
            $table->integer('stock_quantity');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
