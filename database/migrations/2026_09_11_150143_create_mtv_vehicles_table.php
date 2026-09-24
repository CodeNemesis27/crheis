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
        Schema::create('mtv_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mtv_operator_id')->constrained('mtv_operators')->cascadeOnDelete();
            $table->string('plate_number')->unique();
            $table->enum('vehicle_type', [
                'Refrigerated Van',
                'Insulated Truck',
                'Open Truck',
                'Other',
            ]);
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('year_model')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->decimal('capacity_kg', 10, 2)->nullable();

            $table->string('permit_number')->nullable()->unique();
            $table->enum('permit_status', [
                'Pending',
                'Active',
                'Suspended',
                'Revoked',
                'Expired',
            ])->default('Pending')->index();
            $table->date('permit_issued_at')->nullable();
            $table->date('permit_expiry_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mtv_vehicles');
    }
};
