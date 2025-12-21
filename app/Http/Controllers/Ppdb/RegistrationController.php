<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('ppdb.index'); // Landing page
    }

    public function create()
    {
        return view('ppdb.register'); // Form page
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|numeric|digits:10|unique:ppdb_registrations,nisn',
            'nik' => 'required|numeric|digits:16|unique:ppdb_registrations,nik',
            'asal_sekolah' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            
            // Alamat
            'alamat' => 'required|string',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'desa' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|numeric',

            // Ayah
            'nama_ayah' => 'required|string',
            'nik_ayah' => 'required|numeric|digits:16',
            'tahun_lahir_ayah' => 'required|numeric|digits:4',
            'pendidikan_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'penghasilan_ayah' => 'required|string',

            // Ibu
            'nama_ibu' => 'required|string',
            'nik_ibu' => 'required|numeric|digits:16',
            'tahun_lahir_ibu' => 'required|numeric|digits:4',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ibu' => 'required|string',
            
            'no_hp' => 'required|numeric',
            
            // Wali (Nullable)
            'nama_wali' => 'nullable|string',
            'nik_wali' => 'nullable|numeric|digits:16',
            'no_hp_wali' => 'nullable|numeric',
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_akta' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['nomor_pendaftaran'] = 'PPDB-' . date('Y') . '-' . rand(1000, 9999);
        
        if ($request->hasFile('file_kk')) {
            $data['file_kk'] = $request->file('file_kk')->store('ppdb/kk', 'public');
        }
        if ($request->hasFile('file_akta')) {
            $data['file_akta'] = $request->file('file_akta')->store('ppdb/akta', 'public');
        }
        if ($request->hasFile('file_raport')) {
            $data['file_raport'] = $request->file('file_raport')->store('ppdb/raport', 'public');
        }

        $registration = PpdbRegistration::create($data);

        return redirect()->route('ppdb.success', $registration->id)->with('success', 'Pendaftaran berhasil!');
    }

    public function success(PpdbRegistration $registration)
    {
        return view('ppdb.success', compact('registration'));
    }

    public function checkStatus()
    {
        return view('ppdb.check-status');
    }

    public function searchStatus(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|min:4'
        ]);

        $registration = PpdbRegistration::where('nomor_pendaftaran', $request->keyword)
            ->orWhere('nisn', $request->keyword)
            ->first();

        if (!$registration) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan. Mohon cek kembali Nomor Pendaftaran atau NISN anda.');
        }

        return view('ppdb.check-status', compact('registration'));
    }
}
