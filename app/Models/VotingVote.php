<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'voting_event_id',
        'candidate_id',
    ];
}
