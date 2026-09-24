<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EnforcementAction extends Model
{
    protected $fillable = [
        'subject_type',
        'subject_id',
        'violation_id',
        'action_number',
        'action_type',
        'description',
        'penalty_amount',
        'issued_by',
        'office_id',
        'issued_at',
        'effectivity_date',
        'expiry_date',
        'status',
    ];

    protected $casts = [
        'penalty_amount' => 'decimal:2',
        'issued_at' => 'date',
        'effectivity_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function violation(): BelongsTo
    {
        return $this->belongsTo(Violation::class);
    }

    public function issuedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function enforcementCases(): HasMany
    {
        return $this->hasMany(EnforcementCase::class);
    }

    public function getSubjectLabelAttribute(): ?string
    {
        return match (true) {
            $this->subject instanceof MeatEstablishment => $this->subject->business_name,
            $this->subject instanceof MtvOperator => $this->subject->operator_name,
            $this->subject instanceof MtvVehicle => $this->subject->plate_number,
            default => null,
        };
    }

    // Documents attach via polymorphic morphMany('documentable') once the
    // Document model exists.
}
