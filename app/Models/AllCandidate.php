<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllCandidate extends Model
{
     protected $table = 'all_candidates';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'experience_years',
        'previous_experience',
        'age'
    ];

    protected $casts = [
        'previous_experience' => 'array'
    ];
}
