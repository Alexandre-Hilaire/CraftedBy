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
        Schema::create('crafters', function (Blueprint $table) {
            $table->uuid('id');
            $table->timestamps();
            $table->foreignUuid('user_id')->constrained();
            $table->text('information');
            $table->text('story');
            $table->text('crafting_process');
            $table->text('localtion');
            $table->text('material_preference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crafters');
    }
};
