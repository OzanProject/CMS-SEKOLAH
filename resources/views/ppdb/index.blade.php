@extends('layouts.public')

@section('title', 'PPDB Online')

@section('content')
<div class="bg-blue-600 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">Penerimaan Peserta Didik Baru</h1>
        <p class="text-xl mb-8">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
        <a href="{{ route('ppdb.create') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-lg">
            Daftar Sekarang
        </a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="text-4xl mb-4">📝</div>
            <h3 class="text-xl font-bold mb-2">Isi Formulir</h3>
            <p class="text-gray-600">Lengkapi data diri dan data orang tua secara online.</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="text-4xl mb-4">📂</div>
            <h3 class="text-xl font-bold mb-2">Upload Berkas</h3>
            <p class="text-gray-600">Unggah KK, Akta Kelahiran, dan Raport.</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="text-4xl mb-4">✅</div>
            <h3 class="text-xl font-bold mb-2">Verifikasi</h3>
            <p class="text-gray-600">Pantau status pendaftaran melalui dashboard atau pengumuman.</p>
        </div>
    </div>
</div>
@endsection
