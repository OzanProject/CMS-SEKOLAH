<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'voting_event_id',
        'token',
        'name',
        'class_name',
        'type',
        'is_used',
        'used_at',
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(VotingEvent::class, 'voting_event_id');
    }
}
