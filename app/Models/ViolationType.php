<?php

namespace App\Models;

use App\Models\Violation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ViolationType extends Model
{
    protected $fillable = [
        'code',
        'title',
        'category',
        'legal_basis',
        'default_severity',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function violations(): HasMany
    {
        return $this->hasMany(Violation::class);
    }

    // ^ added now even though Violation doesn't exist yet — that's fine,
    // ::class is just a string reference, it's only resolved when this
    // method is actually called (i.e. once we build the Violation resource next).
}
