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
            $table->uuid();
            $table->timestamps();
            $table->foreignUuid('user_id')->constrained();
            $table->stirng('adress_name');
            $table->int('adresse_type');
            $table->stirng('adress_firstname');
            $table->stirng('adress_lastname');
            $table->stirng('first_adress');
            $table->stirng('second_adress');
            $table->int('postal_code');
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
