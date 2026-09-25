<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionCommodity extends Model
{
    protected $fillable = [
        'inspection_id',
        'commodity_type',
        'condition',
        'quantity_kg',
        'origin_establishment_id',
        'mic',
        'mic_remarks',
    ];

    protected $casts = [
        'quantity_kg' => 'decimal:2',
        'mic' => 'boolean',
    ];

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    public function originEstablishment(): BelongsTo
    {
        return $this->belongsTo(MeatEstablishment::class, 'origin_establishment_id');
    }
}
