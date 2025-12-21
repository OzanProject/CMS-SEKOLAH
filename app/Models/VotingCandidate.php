<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingCandidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'voting_event_id',
        'name',
        'photo',
        'nomor_urut',
        'visi',
        'misi',
    ];

    public function votingEvent()
    {
        return $this->belongsTo(VotingEvent::class, 'voting_event_id');
    }

    // Alias for backward compatibility if needed, or prefer votingEvent
    public function event()
    {
        return $this->votingEvent();
    }

    public function votes()
    {
        return $this->hasMany(VotingVote::class, 'candidate_id');
    }
}
