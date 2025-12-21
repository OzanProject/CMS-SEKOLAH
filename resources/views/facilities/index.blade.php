@extends('layouts.public')

@section('title', 'Fasilitas Sekolah')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <ol class="list-reset flex text-xs md:text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-green-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-semibold">Fasilitas</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fasilitas & Sarana Prasarana</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai fasilitas unggulan untuk menunjang kegiatan belajar mengajar dan pengembangan bakat siswa.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($facilities as $facility)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 cursor-pointer" onclick="window.location='{{ route('facilities.show', $facility) }}'">
            <div class="h-56 overflow-hidden relative">
                @if($facility->image)
                    <img src="{{ asset('storage/'.$facility->image) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                @else
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                        <i class="fas fa-building text-5xl"></i>
                    </div>
                @endif
                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition"></div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition">{{ $facility->name }}</h3>
                <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit(strip_tags($facility->description), 100) }}</p>
                <div class="mt-4 flex items-center text-green-600 font-semibold text-sm">
                    Lihat Detail <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-gray-500">
            <i class="fas fa-info-circle text-4xl mb-4 text-gray-300"></i>
            <p>Belum ada data fasilitas yang ditambahkan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
