<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Info extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'group_id'
    ];
    use HasFactory;
    /**
     * Get the group that owns the info.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
