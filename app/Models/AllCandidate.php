<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AllCandidate extends Model
{
     protected $table = 'all_candidates';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'experience_years',
        'previous_experience',
        'age',
        'current_status',
        'hired_at',
        'rejected_at',
        'rejection_reason'
    ];

    protected $casts = [
        'previous_experience' => 'array',
        'hired_at' => 'datetime',
        'rejected_at' => 'datetime'
    ];

    /**
     * Get all interviews for this candidate
     */
    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'candidate_id');
    }

    /**
     * Get status history for this candidate
     */
    public function statusHistory(): HasMany
    {
        return $this->hasMany(CandidateStatus::class, 'candidate_id');
    }

    /**
     * Scope for hired candidates
     */
    public function scopeHired($query)
    {
        return $query->where('current_status', 'hired');
    }

    /**
     * Scope for rejected candidates
     */
    public function scopeRejected($query)
    {
        return $query->where('current_status', 'rejected');
    }

    /**
     * Scope for passed candidates (eligible for second interview)
     */
    public function scopePassed($query)
    {
        return $query->where('current_status', 'passed');
    }

    /**
     * Scope for candidates with upcoming interviews
     */
    public function scopeWithUpcomingInterview($query)
    {
        return $query->where('current_status', 'interview_scheduled');
    }

    /**
     * Update candidate status
     */
    public function updateStatus($status, $userId = null, $notes = null)
    {
        $this->update(['current_status' => $status]);
        
        // Record status change in history
        $this->statusHistory()->create([
            'status' => $status,
            'updated_by' => $userId,
            'notes' => $notes
        ]);

        // Update specific timestamps
        if ($status === 'hired') {
            $this->update(['hired_at' => now()]);
        } elseif ($status === 'rejected') {
            $this->update([
                'rejected_at' => now(),
                'rejection_reason' => $notes
            ]);
        }
    }
}
