<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VotingCandidate;
use App\Models\VotingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VotingCandidateController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, VotingEvent $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_urut' => 'required|integer',
            'photo' => 'nullable|image|max:2048', // 2MB Max
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['voting_event_id'] = $event->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('voting/candidates', 'public');
        }

        VotingCandidate::create($data);

        return redirect()->route('admin.voting.show', $event->id)->with('success', 'Kandidat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VotingCandidate $candidate)
    {
        $event = $candidate->votingEvent;

        return view('admin.voting.candidates.show', compact('candidate', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VotingCandidate $candidate)
    {
        $event = $candidate->votingEvent;

        return view('admin.voting.candidates.edit', compact('candidate', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VotingCandidate $candidate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_urut' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($candidate->photo) {
                Storage::disk('public')->delete($candidate->photo);
            }
            $data['photo'] = $request->file('photo')->store('voting/candidates', 'public');
        }

        $candidate->update($data);

        return redirect()->route('admin.voting.show', $candidate->voting_event_id)->with('success', 'Data kandidat diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VotingCandidate $candidate)
    {
        $eventId = $candidate->voting_event_id;

        if ($candidate->photo) {
            Storage::disk('public')->delete($candidate->photo);
        }

        $candidate->delete();

        return redirect()->route('admin.voting.show', $eventId)->with('success', 'Kandidat dihapus.');
    }
}
