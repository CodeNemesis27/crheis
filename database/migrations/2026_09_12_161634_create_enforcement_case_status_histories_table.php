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
        Schema::create('enforcement_case_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enforcement_case_id')
                ->constrained('enforcement_cases')
                ->cascadeOnDelete();
            $table->enum('status', [
                'Pending',
                'Under Review',
                'Resolved',
                'Under Appeal',
                'Dismissed',
                'Completed',
            ]);
            $table->text('remarks')->nullable();
            $table->foreignId('changed_by')->constrained('users')->restrictOnDelete();
            $table->timestamp('changed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enforcement_case_status_histories');
    }
};
