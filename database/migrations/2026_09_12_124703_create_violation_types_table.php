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
        Schema::create('violation_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->enum('category', [
                'Sanitation',
                'Documentation',
                'Unauthorized Operation',
                'Animal Welfare',
                'Transport Violation',
                'Food Safety',
                'Other',
            ]);
            $table->string('legal_basis')->nullable();
            $table->enum('default_severity', ['Minor', 'Major', 'Critical']);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violation_types');
    }
};
