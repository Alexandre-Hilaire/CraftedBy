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
        Schema::create('oders', function (Blueprint $table) {
            $table->uuid();
            $table->timestamps();
            $table->foreignUuid('user_id')->constrained();
            $table->int('oder_status');
            $table->float('order_price');
            $table->date('order_date');
            $table->string('delivery_adress');
            $table->string('facturation_adress');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oders');
    }
};