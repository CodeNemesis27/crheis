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
        Schema::create('enforcement_actions', function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->foreignId('violation_id')
                ->nullable()
                ->constrained('violations')
                ->nullOnDelete();
            $table->string('action_number')->unique();
            $table->enum('action_type', [
                'Notice Of Violation',
                'Warning',
                'Show Cause Order',
                'Suspension',
                'Revocation',
                'Fine',
                'Closure Order',
                'Other',
            ]);
            $table->text('description')->nullable();
            $table->decimal('penalty_amount', 12, 2)->nullable();
            $table->foreignId('issued_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('office_id')->constrained('offices')->restrictOnDelete();
            $table->date('issued_at');
            $table->date('effectivity_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->enum('status', [
                'Issued',
                'Acknowledged',
                'Complied',
                'Contested',
                'Lifted',
            ])->default('Issued')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enforcement_actions');
    }
};
