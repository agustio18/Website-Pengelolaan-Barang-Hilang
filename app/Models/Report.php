<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Report extends Model
{
    protected $fillable = [
        'code',
        'type',
        'reporter_name',
        'reporter_phone',
        'receiver_staff',
        'category_id',
        'item_name',
        'description',
        'location',
        'event_date',
        'photo',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function handover(): HasOne
    {
        return $this->hasOne(Handover::class);
    }
}
