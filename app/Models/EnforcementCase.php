<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EnforcementCase extends Model
{
    protected $fillable = [
        'subject_type',
        'subject_id',
        'violation_id',
        'enforcement_action_id',
        'case_number',
        'filed_at',
        'current_status',
        'assigned_office_id',
        'assigned_officer_id',
        'resolution',
        'resolved_at',
        'is_confidential',
    ];

    protected $casts = [
        'filed_at' => 'date',
        'resolved_at' => 'date',
        'is_confidential' => 'boolean',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function violation(): BelongsTo
    {
        return $this->belongsTo(Violation::class);
    }

    public function enforcementAction(): BelongsTo
    {
        return $this->belongsTo(EnforcementAction::class);
    }

    public function assignedOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'assigned_office_id');
    }

    public function assignedOfficer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_officer_id');
    }

    public function statusHistory(): HasMany
    {
        return $this->hasMany(EnforcementCaseStatusHistory::class)->orderBy('changed_at');
    }

    public function confiscations(): HasMany
    {
        return $this->hasMany(Confiscation::class);
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
