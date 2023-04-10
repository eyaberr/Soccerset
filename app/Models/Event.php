<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    /**
     * The children that belong to the event.
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class);
    }
    /**
     * Get the images for the event.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    /**
     * Get the videos for the event.
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
