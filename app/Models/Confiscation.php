<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Confiscation extends Model
{
    protected $fillable = [
        'subject_type',
        'subject_id',
        'enforcement_case_id',
        'confiscation_number',
        'type',
        'date_confiscated',
        'location',
        'item_description',
        'commodity_type',
        'quantity',
        'unit',
        'estimated_value',
        'apprehending_officer_id',
        'office_id',
        'disposition',
        'disposition_date',
        'remarks',
    ];

    protected $casts = [
        'date_confiscated' => 'date',
        'disposition_date' => 'date',
        'quantity' => 'decimal:2',
        'estimated_value' => 'decimal:2',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function enforcementCase(): BelongsTo
    {
        return $this->belongsTo(EnforcementCase::class);
    }

    public function apprehendingOfficer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'apprehending_officer_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
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
