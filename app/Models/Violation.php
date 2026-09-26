<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Violation extends Model
{
    protected $fillable = [
        'subject_type',
        'subject_id',
        'inspection_id',
        'violation_type_id',
        'violation_number',
        'date_committed',
        'date_reported',
        'severity',
        'description',
        'attachment',
        'status',
        'reported_by',
        'office_id',
    ];

    protected $casts = [
        'date_committed' => 'date',
        'date_reported' => 'date',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    public function violationType(): BelongsTo
    {
        return $this->belongsTo(ViolationType::class);
    }

    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function enforcementActions(): HasMany
    {
        return $this->hasMany(EnforcementAction::class);
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
}
