@extends('layouts.public')

@section('title', 'Cek Status Pendaftaran')

@section('content')
<div class="relative bg-gradient-to-r from-blue-800 to-indigo-900 pb-32 pt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4">
            Cek Status Kelulusan
        </h1>
        <p class="text-lg text-blue-200 max-w-3xl mx-auto">
            Masukkan Nomor Pendaftaran atau NISN untuk melihat hasil seleksi.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-20 relative z-10">
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100 p-8">
        
        <!-- Search Form -->
        <form action="{{ route('ppdb.search-status') }}" method="POST" class="mb-10">
            @csrf
            <div class="flex flex-col md:flex-row gap-4">
                <input type="text" name="keyword" class="flex-1 form-input rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-lg py-3" placeholder="Masukkan Nomor Pendaftaran (PPDB-202X-XXXX) atau NISN" required>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition transform hover:-translate-y-1">
                    <i class="fas fa-search mr-2"></i> Cek Status
                </button>
            </div>
            @if(session('error'))
                <div class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif
        </form>

        @if(isset($registration))
        <!-- Result Section -->
        <div class="text-center animate-fade-in-up">
            <div class="inline-block p-4 rounded-full bg-gray-100 mb-6">
                <i class="fas fa-user-graduate text-4xl text-gray-600"></i>
            </div>
            
            <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $registration->nama_lengkap }}</h2>
            <p class="text-gray-500 mb-8">{{ $registration->nomor_pendaftaran }} | {{ $registration->asal_sekolah }}</p>

            @if($registration->status == 'diterima')
                <div class="bg-green-50 border-l-8 border-green-500 p-8 rounded-r-lg text-left shadow-sm">
                    <h3 class="text-2xl font-bold text-green-700 mb-2"><i class="fas fa-check-circle mr-2"></i> SELAMAT! ANDA DITERIMA</h3>
                    <p class="text-green-800 text-lg mb-4">
                        Selamat bergabung menjadi bagian dari kami. Silakan lakukan daftar ulang dengan membawa berkas asli ke sekolah.
                    </p>
                    @if($registration->catatan)
                        <div class="bg-white p-4 rounded border border-green-200">
                            <strong>Catatan Panitia:</strong><br>
                            {{ $registration->catatan }}
                        </div>
                    @endif
                </div>
            @elseif($registration->status == 'ditolak')
                <div class="bg-red-50 border-l-8 border-red-500 p-8 rounded-r-lg text-left shadow-sm">
                    <h3 class="text-2xl font-bold text-red-700 mb-2"><i class="fas fa-times-circle mr-2"></i> MOHON MAAF</h3>
                    <p class="text-red-800 text-lg mb-4">
                        Berdasarkan hasil seleksi dan verifikasi berkas, anda dinyatakan <strong>TIDAK DITERIMA</strong>.
                    </p>
                    @if($registration->catatan)
                        <div class="bg-white p-4 rounded border border-red-200">
                            <strong>Alasan Penolakan:</strong><br>
                            {{ $registration->catatan }}
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-yellow-50 border-l-8 border-yellow-500 p-8 rounded-r-lg text-left shadow-sm">
                    <h3 class="text-2xl font-bold text-yellow-700 mb-2"><i class="fas fa-clock mr-2"></i> SEDANG DIVERIFIKASI</h3>
                    <p class="text-yellow-800 text-lg">
                        Data pendaftaran anda sedang dalam proses pengecekan oleh panitia. Mohon cek kembali secara berkala.
                    </p>
                </div>
            @endif

        </div>
        @endif

    </div>
</div>
@endsection
