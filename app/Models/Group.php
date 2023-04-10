<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;
    /**
     * The childre that belong to the group.
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class);
    }
    /**
 * Get the infos for the group.
 */
    public function infos(): HasMany
    {
        return $this->hasMany(Info::class);
    }
}
