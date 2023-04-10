<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Info extends Model
{
    use HasFactory;
    /**
     * Get the group that owns the info.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
