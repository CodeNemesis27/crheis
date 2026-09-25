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
        Schema::create('inspection_commodities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_id')->constrained('inspections')->cascadeOnDelete();
            $table->enum('commodity_type', ['Beef', 'Pork', 'Chicken', 'Others']);
            $table->string('condition')->nullable();
            $table->decimal('quantity_kg', 10, 2)->nullable();
            $table->foreignId('origin_establishment_id')->nullable()->constrained('meat_establishments')->nullOnDelete();
            $table->boolean('mic')->nullable();
            $table->text('mic_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_commodities');
    }
};
