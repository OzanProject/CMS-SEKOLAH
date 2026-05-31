<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VotingCandidate;
use App\Models\VotingEvent;
use App\Models\VotingToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VotingController extends Controller
{
    public function index()
    {
        $events = VotingEvent::latest()->get();

        return view('admin.voting.index', compact('events'));
    }

    public function create()
    {
        return view('admin.voting.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        VotingEvent::create($request->all());

        return redirect()->route('admin.voting.index')->with('success', 'Event voting dibuat.');
    }

    public function show(Request $request, VotingEvent $voting)
    {
        $event = $voting;
        $event->load('candidates'); // Don't load tokens relation here to avoid overhead

        $query = $event->tokens();

        if ($request->has('type') && in_array($request->type, ['siswa', 'guru', 'panitia'])) {
            $query->where('type', $request->type);
        }

        $tokens = $query->paginate(10); // Paginate tokens
        $classrooms = \App\Models\Classroom::all();

        return view('admin.voting.show', compact('event', 'tokens', 'classrooms'));
    }

    public function exportTokensPdf(VotingEvent $event)
    {
        $tokens = $event->tokens; // Get all tokens

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.voting.pdf_tokens', compact('event', 'tokens'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Token_'.Str::slug($event->title).'.pdf');
    }

    public function storeCandidate(Request $request, VotingEvent $event)
    {
        $request->validate([
            'name' => 'required',
            'nomor_urut' => 'required|integer',
            'photo' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['voting_event_id'] = $event->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('voting/candidates', 'public');
        }

        VotingCandidate::create($data);

        return back()->with('success', 'Kandidat ditambahkan.');
    }

    public function generateTokens(Request $request, VotingEvent $event)
    {
        $request->validate([
            'count' => 'nullable|integer|min:1',
            'type' => 'required|in:guru,siswa,panitia',
            'classroom_id' => 'nullable', // Remove exists validation to allow string 'teacher_all'
        ]);

        // Generate for Teachers (Master Data)
        if ($request->classroom_id === 'teacher_all') {
            $teachers = \App\Models\Teacher::all();
            if ($teachers->count() == 0) {
                return back()->with('error', 'Data Guru masih kosong. Silakan import dulu di Data Master.');
            }

            foreach ($teachers as $teacher) {
                VotingToken::create([
                    'voting_event_id' => $event->id,
                    'token' => Str::upper(Str::random(6)),
                    'type' => 'guru',
                    'name' => $teacher->name,
                    'class_name' => 'GURU',
                ]);
            }

            return back()->with('success', $teachers->count().' Token untuk Guru berhasil digenerate.');
        }

        // Generate for Committees (Master Data)
        if ($request->classroom_id === 'committee_all') {
            $committees = \App\Models\Committee::all();
            if ($committees->count() == 0) {
                return back()->with('error', 'Data Panitia masih kosong. Silakan import dulu di Data Master.');
            }

            foreach ($committees as $committee) {
                VotingToken::create([
                    'voting_event_id' => $event->id,
                    'token' => Str::upper(Str::random(6)),
                    'type' => 'panitia',
                    'name' => $committee->name,
                    'class_name' => 'PANITIA',
                ]);
            }

            return back()->with('success', $committees->count().' Token untuk Panitia berhasil digenerate.');
        }

        // Generate for Students (Classroom)
        if ($request->filled('classroom_id') && is_numeric($request->classroom_id)) {
            $classroom = \App\Models\Classroom::with('students')->find($request->classroom_id);

            if (! $classroom || $classroom->students->count() == 0) {
                return back()->with('error', 'Kelas ini tidak memiliki siswa.');
            }

            foreach ($classroom->students as $student) {
                VotingToken::create([
                    'voting_event_id' => $event->id,
                    'token' => Str::upper(Str::random(6)),
                    'type' => 'siswa',
                    'name' => $student->name,
                    'class_name' => $classroom->name,
                ]);
            }

            return back()->with('success', $classroom->students->count().' Token untuk kelas '.$classroom->name.' berhasil digenerate.');
        }

        if (! $request->count) {
            return back()->with('error', 'Masukkan jumlah token atau pilih sumber data.');
        }

        for ($i = 0; $i < $request->count; $i++) {
            VotingToken::create([
                'voting_event_id' => $event->id,
                'token' => Str::upper(Str::random(6)),
                'type' => $request->type,
            ]);
        }

        return back()->with('success', $request->count.' Token berhasil digenerate.');
    }

    public function resetTokens(VotingEvent $event)
    {
        $event->tokens()->delete();

        return back()->with('success', 'Semua token berhasil dihapus. DPT telah di-reset.');
    }

    public function destroy(VotingEvent $voting)
    {
        // Manual cascade delete for safety
        $voting->tokens()->delete();
        $voting->candidates()->delete(); // Add logic to delete candidate photos if needed
        // Assuming votes are related to candidates or event, those should be deleted too if exists
        // $voting->votes()->delete(); // If hasMany votes relationship exists

        $voting->delete();

        return redirect()->route('admin.voting.index')->with('success', 'Event voting berhasil dihapus.');
    }
}
