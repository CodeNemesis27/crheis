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
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->foreignId('inspection_id')
                ->nullable()
                ->constrained('inspections')
                ->nullOnDelete();
            $table->foreignId('violation_type_id')
                ->constrained('violation_types')
                ->restrictOnDelete();
            $table->string('violation_number')->unique();
            $table->date('date_committed');
            $table->date('date_reported');
            $table->enum('severity', ['Minor', 'Major', 'Critical']);
            $table->text('description');
            $table->text('attachment')->nullable();
            $table->enum('status', [
                'Open',
                'Under Investigation',
                'Resolved',
                'Dismissed',
            ])->default('Open')->index();
            $table->foreignId('reported_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('office_id')->constrained('offices')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};
