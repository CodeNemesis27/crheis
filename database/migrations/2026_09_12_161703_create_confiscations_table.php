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
        Schema::create('confiscations', function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->foreignId('enforcement_case_id')
                ->nullable()
                ->constrained('enforcement_cases')
                ->nullOnDelete();
            $table->string('confiscation_number')->unique();
            $table->enum('type', ['Confiscation', 'Apprehension', 'Seizure']);
            $table->date('date_confiscated');
            $table->string('location');
            $table->text('item_description');
            $table->enum('commodity_type', [
                'Live Animal',
                'Carcass',
                'Processed Meat',
                'Vehicle',
                'Equipment',
                'Document',
                'Other',
            ]);
            $table->decimal('quantity', 10, 2)->nullable();
            $table->string('unit')->nullable();
            $table->decimal('estimated_value', 12, 2)->nullable();
            $table->foreignId('apprehending_officer_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('office_id')->constrained('offices')->restrictOnDelete();
            $table->enum('disposition', [
                'Pending',
                'Donated',
                'Destroyed',
                'Released',
                'Forfeited',
                'Sold',
            ])->default('Pending')->index();
            $table->date('disposition_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confiscations');
    }
};
