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
            $table->uuid();
            $table->timestamps();
            $table->foreignUuid('model_id')->constrained()->nullable();
            $table->foreignUuid('user_id')->constrained();
            $table->float('unit_price');
            $table->string('name');
            $table->string('description');
            $table->int('status');
            $table->string('color');
            $table->int('customizable')->nullable();
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
