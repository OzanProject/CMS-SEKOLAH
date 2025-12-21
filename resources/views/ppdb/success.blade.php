@extends('layouts.public')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-20 text-center">
    <div class="bg-white p-8 rounded-lg shadow-lg border-t-8 border-green-500">
        <div class="text-6xl mb-4">✅</div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pendaftaran Berhasil!</h1>
        <p class="text-lg text-gray-600 mb-8">
            Terima kasih telah mendaftar di SMPN 4 Konoha.
        </p>
        
        <div class="bg-gray-50 p-6 rounded-md text-left mb-6">
            <p><strong>Nama Lengkap:</strong> {{ $registration->nama_lengkap }}</p>
            <p><strong>Nomor Pendaftaran:</strong> <span class="text-blue-600 font-bold font-mono">{{ $registration->nomor_pendaftaran }}</span></p>
            <p class="text-sm text-gray-500 mt-2">*Simpan nomor pendaftaran ini untuk mengecek status kelulusan.</p>
        </div>

        <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Kembali ke Beranda</a>
    </div>
</div>
@endsection
