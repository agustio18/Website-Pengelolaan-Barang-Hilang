<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Handover extends Model
{
    protected $fillable = [
        'report_id',
        'recipient_name',
        'recipient_identity',
        'handover_date',
        'officer_name',
        'notes',
    ];

    protected $casts = [
        'handover_date' => 'date',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
