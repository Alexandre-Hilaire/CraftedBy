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
        Schema::create('materials_product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('material_name');
            $table->foreignUuid('product_id')->constrained();
            $table->foreignUuid('material_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials_product');
    }
};
