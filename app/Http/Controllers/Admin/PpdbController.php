<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PpdbController extends Controller
{
    public function index()
    {
        $registrants = PpdbRegistration::latest()->paginate(20);
        return view('admin.ppdb.index', compact('registrants'));
    }

    public function show(PpdbRegistration $registration)
    {
        return view('admin.ppdb.show', compact('registration'));
    }

    public function updateStatus(Request $request, PpdbRegistration $registration)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $registration->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }


    public function destroy(PpdbRegistration $registration)
    {
        // Delete files if exists
        // ... implementation needed for file cleanup
        
        $registration->delete();
        return redirect()->route('admin.ppdb.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function exportPdf()
    {
        $registrants = PpdbRegistration::oldest()->get();
        $school_settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        $pdf = Pdf::loadView('admin.ppdb.pdf', compact('registrants', 'school_settings'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-PPDB-' . date('Y-m-d') . '.pdf');
    }
}
