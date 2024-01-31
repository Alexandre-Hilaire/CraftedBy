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
        Schema::create('oder_product', function (Blueprint $table) {
            $table->uuid();
            $table->foreignUuid('product_id');
            $table->foreignUuid('order_id');
            $table->string('product_name');
            $table->float('product_unit_price');
            $table->int('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oder_product');
    }
};
