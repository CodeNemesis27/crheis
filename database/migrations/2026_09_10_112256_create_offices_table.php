<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Represents every office/unit that can originate a record: NMIS Central
 * Office, Regional Field Units, Provincial/City Meat Inspection Services,
 * and LGUs exercising devolved enforcement functions. Every record-producing
 * table below references an office so that "who created this record" and
 * "which office holds jurisdiction" is always explicit — this is what makes
 * cross-office reconciliation possible instead of relying on manual
 * cross-referencing.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', ['National', 'Regional', 'Provincial', 'City', 'Municipal', 'LGU',]);
            $table->foreignId('parent_office_id')->nullable()->constrained('offices')->nullOnDelete();
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('city_municipality')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
