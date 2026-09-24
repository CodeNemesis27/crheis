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
        Schema::create('mtv_operators', function (Blueprint $table) {
            $table->id();
            $table->enum('operator_type', ['Individual', 'Company']);
            $table->string('operator_name')->index();
            $table->string('owner_name')->nullable()->index();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('tin')->nullable();
            $table->string('business_permit_number')->nullable();

            $table->string('address_line')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city_municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();

            $table->string('accreditation_number')->nullable()->unique();
            $table->enum('accreditation_status', [
                'Pending',
                'Active',
                'Suspended',
                'Revoked',
                'Expired',
                'Closed',
            ])->default('Pending')->index();
            $table->date('accreditation_issued_at')->nullable();
            $table->date('accreditation_expiry_at')->nullable();

            $table->foreignId('registering_office_id')
                ->constrained('offices')
                ->restrictOnDelete();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mtv_operators');
    }
};
