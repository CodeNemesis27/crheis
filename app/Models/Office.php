<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'type',
        'parent_office_id',
        'region',
        'province',
        'city_municipality',
        'contact_number',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parentOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'parent_office_id');
    }

    public function childOffices(): HasMany
    {
        return $this->hasMany(Office::class, 'parent_office_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function meatEstablishments(): HasMany
    {
        return $this->hasMany(MeatEstablishment::class, 'registering_office_id');
    }

    public function mtvOperators(): HasMany
    {
        return $this->hasMany(MtvOperator::class, 'registering_office_id');
    }

    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    public function violations(): HasMany
    {
        return $this->hasMany(Violation::class);
    }

    public function enforcementActions(): MorphMany
    {
        return $this->morphMany(EnforcementAction::class, 'subject');
    }

    public function enforcementCases(): HasMany
    {
        return $this->hasMany(EnforcementCase::class, 'assigned_office_id');
    }

    public function confiscations(): HasMany
    {
        return $this->hasMany(Confiscation::class);
    }

    // Note: hasMany relations to MeatEstablishment, MtvOperator, Inspection,
    // Violation, EnforcementAction, EnforcementCase, and Confiscation belong
    // here too (they all have an office_id/registering_office_id FK), but
    // those model classes don't exist yet in our build order. We'll come
    // back and add each one to this model as we generate its resource.
}
