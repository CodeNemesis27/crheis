<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MtvOperator extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'operator_type',
        'operator_name',
        'owner_name',
        'contact_number',
        'email',
        'tin',
        'business_permit_number',
        'address_line',
        'barangay',
        'city_municipality',
        'province',
        'region',
        'accreditation_number',
        'accreditation_status',
        'accreditation_issued_at',
        'accreditation_expiry_at',
        'registering_office_id',
        'created_by',
        'remarks',
    ];

    protected $casts = [
        'accreditation_issued_at' => 'date',
        'accreditation_expiry_at' => 'date',
    ];

    public function registeringOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'registering_office_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(MtvVehicle::class);
    }

    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    public function violations(): MorphMany
    {
        return $this->morphMany(Violation::class, 'subject');
    }

    public function enforcementActions(): MorphMany
    {
        return $this->morphMany(EnforcementAction::class, 'subject');
    }

    public function enforcementCases(): MorphMany
    {
        return $this->morphMany(EnforcementCase::class, 'subject');
    }

    public function confiscations(): MorphMany
    {
        return $this->morphMany(Confiscation::class, 'subject');
    }

    // Inspections, Violations, EnforcementActions, EnforcementCases,
    // Confiscations, Documents, and EntityIdentifiers attach here via a
    // polymorphic morphMany('subject') — added once those models exist.
}
