<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;
    /**
         * Get the users for the role.
         */
        public function users(): HasMany
        {
            return $this->hasMany(User::class);
        }
         /**
             * The users that belong to the role.
             */
            public function permissions(): BelongsToMany
            {
                return $this->belongsToMany(Permission::class);
            }
}
