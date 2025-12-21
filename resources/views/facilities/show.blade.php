@extends('layouts.public')

@section('title', $facility->name)

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <ol class="list-reset flex text-xs md:text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-green-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ url('/') }}#facility" class="hover:text-green-600">Fasilitas</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-semibold">{{ $facility->name }}</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Facility Image -->
            <div class="relative h-96">
                @if($facility->image)
                    <img src="{{ asset('storage/'.$facility->image) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-building text-6xl text-gray-400"></i>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end">
                    <div class="p-8 md:p-12 w-full">
                        <span class="inline-block bg-green-600 text-white text-xs font-bold px-3 py-1 rounded mb-3 uppercase tracking-wider shadow-sm">
                            Fasilitas Unggulan
                        </span>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 text-shadow-md">{{ $facility->name }}</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Description -->
                    <div class="flex-1 prose prose-lg text-gray-700">
                         <h3 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-green-100 pb-2">Deskripsi Fasilitas</h3>
                        {!! $facility->description !!}
                    </div>

                    <!-- Meta / CTA -->
                    <div class="w-full md:w-1/3 space-y-6">
                        <div class="bg-green-50 p-6 rounded-xl border border-green-100 text-center">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-green-600 shadow mx-auto mb-4">
                                <i class="fas fa-check-circle text-3xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Standar Kualitas</h4>
                            <p class="text-sm text-gray-600">Fasilitas ini telah memenuhi standar kualitas pendidikan nasional untuk menunjang kegiatan belajar mengajar.</p>
                        </div>

                         <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 text-center">
                            <h4 class="font-bold text-gray-900 mb-4">Ingin tahu lebih lanjut?</h4>
                            <a href="{{ url('/') }}#contact" class="inline-block px-6 py-3 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition w-full">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between items-center">
                    <a href="{{ url('/') }}#facility" class="text-gray-500 hover:text-green-600 font-medium flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Fasilitas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
