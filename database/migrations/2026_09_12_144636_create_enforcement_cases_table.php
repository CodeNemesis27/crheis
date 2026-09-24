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
        Schema::create('enforcement_cases', function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->foreignId('violation_id')
                ->nullable()
                ->constrained('violations')
                ->nullOnDelete();
            $table->foreignId('enforcement_action_id')
                ->nullable()
                ->constrained('enforcement_actions')
                ->nullOnDelete();
            $table->string('case_number')->unique();
            $table->date('filed_at');
            $table->enum('current_status', [
                'Pending',
                'Under Review',
                'Resolved',
                'Under Appeal',
                'Dismissed',
                'Completed',
            ])->default('Pending')->index();
            $table->foreignId('assigned_office_id')->constrained('offices')->restrictOnDelete();
            $table->foreignId('assigned_officer_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->text('resolution')->nullable();
            $table->date('resolved_at')->nullable();
            $table->boolean('is_confidential')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enforcement_cases');
    }
};
