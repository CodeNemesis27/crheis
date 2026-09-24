<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'employee_id',
        'office_id',
        'role',
        'position',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function createdMeatEstablishments(): HasMany
    {
        return $this->hasMany(MeatEstablishment::class, 'created_by');
    }

    public function createdMtvOperators(): HasMany
    {
        return $this->hasMany(MtvOperator::class, 'created_by');
    }

    public function inspectionsConducted(): HasMany
    {
        return $this->hasMany(Inspection::class, 'inspector_id');
    }

    public function createdInspections(): HasMany
    {
        return $this->hasMany(Inspection::class, 'created_by');
    }

    public function reportedViolations(): HasMany
    {
        return $this->hasMany(Violation::class, 'reported_by');
    }

    public function issuedEnforcementActions(): HasMany
    {
        return $this->hasMany(EnforcementAction::class, 'issued_by');
    }

    public function assignedEnforcementCases(): HasMany
    {
        return $this->hasMany(EnforcementCase::class, 'assigned_officer_id');
    }

    public function enforcementCaseStatusChanges(): HasMany
    {
        return $this->hasMany(EnforcementCaseStatusHistory::class, 'changed_by');
    }

    public function apprehensionsRecorded(): HasMany
    {
        return $this->hasMany(Confiscation::class, 'apprehending_officer_id');
    }

    // Inspection (inspector), Violation (reporter), EnforcementAction (issuer),
    // EnforcementCase (assigned officer), Confiscation (apprehending officer),
    // Document (uploader), AuditLog — added here as each is built.
}
