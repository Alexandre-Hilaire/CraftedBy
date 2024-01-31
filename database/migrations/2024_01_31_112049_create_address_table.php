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
        Schema::create('address', function (Blueprint $table) {
            $table->uuid('id');
            $table->timestamps();
            $table->foreignUuid('user_id')->constrained();
            $table->string('adress_name');
            $table->integer('adresse_type');
            $table->string('adress_firstname');
            $table->string('adress_lastname');
            $table->string('first_adress');
            $table->string('second_adress');
            $table->integer('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
