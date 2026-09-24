<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Inspection extends Model
{
    protected $fillable = [
        'subject_type',
        'subject_id',
        'report_number',
        'inspection_type',
        'inspection_date',
        'inspector_id',
        'office_id',
        'result',
        'findings',
        'recommendations',
        'created_by',
    ];

    protected $casts = [
        'inspection_date' => 'date',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function violations(): HasMany
    {
        return $this->hasMany(Violation::class);
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
