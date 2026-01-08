<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateStatus extends Model
{
    protected $fillable = [
        'candidate_id',
        'status',
        'updated_by',
        'notes'
    ];

    /**
     * Get the candidate for this status
     */
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(AllCandidate::class, 'candidate_id');
    }

    /**
     * Get the user who updated this status
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
