<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    protected $fillable = [
        'candidate_id',
        'interview_date',
        'interview_time',
        'interview_type',
        'status',
        'notes',
        'completed_at'
    ];

    protected $casts = [
        'interview_date' => 'date',
        'interview_time' => 'datetime:H:i',
        'completed_at' => 'datetime'
    ];

    /**
     * Get the candidate for this interview
     */
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(AllCandidate::class, 'candidate_id');
    }

    /**
     * Scope for upcoming interviews
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
                    ->where('interview_date', '>=', now()->toDateString())
                    ->orderBy('interview_date')
                    ->orderBy('interview_time');
    }

    /**
     * Scope for completed interviews
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed')
                    ->orderBy('completed_at', 'desc');
    }

    /**
     * Scope for past-date interviews that should be moved to completed
     */
    public function scopePastDue($query)
    {
        return $query->where('status', 'upcoming')
                    ->where('interview_date', '<', now()->toDateString());
    }

    /**
     * Mark interview as completed
     */
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);
    }
}
