<?php

namespace App\Http\Controllers\Voting;

use App\Http\Controllers\Controller;
use App\Models\VotingEvent;
use App\Models\VotingToken;
use App\Models\VotingCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VoteController extends Controller
{
    public function login()
    {
        return view('voting.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate(['token' => 'required']);

        $token = VotingToken::where('token', $request->token)
            ->where('is_used', false)
            ->first();

        if (!$token) {
            return back()->with('error', 'Token tidak valid atau sudah digunakan.');
        }
        
        // Cek event aktif
        $event = $token->event;
        if (!$event->is_active) { // Simplifikasi, harusnya cek date juga
             return back()->with('error', 'Event voting belum dimulai atau sudah selesai.');
        }

        // Store to session
        Session::put('voting_token_id', $token->id);
        Session::put('voting_event_id', $event->id);

        return redirect()->route('voting.ballot');
    }

    public function ballot()
    {
        if (!Session::has('voting_token_id')) {
            return redirect()->route('voting.login');
        }

        $eventId = Session::get('voting_event_id');
        $event = VotingEvent::with('candidates')->find($eventId);

        return view('voting.ballot', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:voting_candidates,id',
        ]);

        if (!Session::has('voting_token_id')) {
            return redirect()->route('voting.login')->with('error', 'Sesi habis, silakan login ulang.');
        }

        $tokenId = Session::get('voting_token_id');
        $token = VotingToken::find($tokenId);

        if (!$token || $token->is_used) {
            return redirect()->route('voting.login')->with('error', 'Token tidak valid atau sudah digunakan.');
        }

        // Simpan Suara
        \App\Models\VotingVote::create([ // Pastikan Model VotingVote dibuat
            'voting_event_id' => $token->voting_event_id,
            'candidate_id' => $request->candidate_id,
        ]);

        // Tandai Token Terpakai
        $token->update([
            'is_used' => true,
            'used_at' => now(),
        ]);

        // Hapus Sesi
        Session::forget(['voting_token_id', 'voting_event_id']);

        return redirect()->route('voting.login')->with('success', 'Terima kasih, suara Anda telah direkam.');
    }
}
