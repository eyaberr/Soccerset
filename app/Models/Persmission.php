<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
        /**
         * The permissions that belong to the role.
         */
        public function roles(): BelongsToMany
        {
            return $this->belongsToMany(Role::class);
        }
}
