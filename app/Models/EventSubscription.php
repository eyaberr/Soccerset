<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSubscription extends Model
{
    use HasFactory;

    const STATUS = [
        'not_defined' => 0,
        'present' => 1,
        'absent' => 2
    ];

    /**
     * Get the event that owns the subscriptions.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
    /**
     * Get the child that owns the subscriptions.
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}
