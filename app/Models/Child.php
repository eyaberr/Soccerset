<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Child extends Model
{
    use HasFactory;
    /**
     * Get the parent that owns the child.
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * The groups that belong to the child.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }
    /**
     * The users that belong to the role.
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
