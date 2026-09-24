<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Extends Laravel's default `users` table (already created by the framework's
 * base migration) with the fields needed to enforce "authorized personnel"
 * and "appropriate legal and access controls" from the pitch: which office a
 * user belongs to, what role they hold, and whether their account is active.
 *
 * For anything beyond simple role checks, pair this with a permissions
 * package (e.g. spatie/laravel-permission) rather than hardcoding more
 * role logic into this table.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_id')->nullable()->unique()->after('id');
            $table->foreignId('office_id')->nullable()->after('employee_id')->constrained('offices')->nullOnDelete();
            $table->enum('role', [
                'System Admin',
                'NMIS Central',
                'NMIS Regional',
                'Inspector',
                'Legal Officer',
                'LGU Staff',
                'Viewer',
            ])->default('Viewer')->after('office_id');
            $table->string('position')->nullable()->after('role');
            $table->boolean('is_active')->default(true)->after('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
