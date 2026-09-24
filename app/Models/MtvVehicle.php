<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MtvVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mtv_operator_id',
        'plate_number',
        'vehicle_type',
        'make',
        'model',
        'year_model',
        'engine_number',
        'chassis_number',
        'capacity_kg',
        'permit_number',
        'permit_status',
        'permit_issued_at',
        'permit_expiry_at',
    ];

    protected $casts = [
        'capacity_kg' => 'decimal:2',
        'permit_issued_at' => 'date',
        'permit_expiry_at' => 'date',
    ];

    public function mtvOperator(): BelongsTo
    {
        return $this->belongsTo(MtvOperator::class);
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
}
