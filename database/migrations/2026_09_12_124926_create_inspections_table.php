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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->morphs('subject'); // subject_type, subject_id (+ index)
            $table->string('report_number')->unique();
            $table->enum('inspection_type', [
                'Routine',
                'Follow Up',
                'Complaint Based',
                'Pre Accreditation',
                'Renewal',
            ]);
            $table->date('inspection_date');
            $table->foreignId('inspector_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('office_id')->constrained('offices')->restrictOnDelete();
            $table->enum('result', ['Passed', 'Passed With Findings', 'Failed']);
            $table->text('findings')->nullable();
            $table->text('recommendations')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
