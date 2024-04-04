<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdvNumber extends Model
{
    use HasFactory;
    /**
     * Get the year that owns the AdvNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    /**
     * Get all of the comments for the AdvNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
}
