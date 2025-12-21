@extends('layouts.public')

@section('title', 'Program Unggulan')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <ol class="list-reset flex text-xs md:text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-green-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-semibold">Program Unggulan</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Program Unggulan Sekolah</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Berbagai program pilihan untuk mengembangkan potensi akademik dan non-akademik siswa.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($programs as $program)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 cursor-pointer" onclick="window.location='{{ route('programs.show', $program) }}'">
            <div class="h-56 overflow-hidden relative">
                @if($program->image)
                    <img src="{{ asset('storage/'.$program->image) }}" alt="{{ $program->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                @else
                    <img src="https://source.unsplash.com/random/400x300?education,school&sig={{ $loop->index }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                @endif
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition"></div>
                <div class="absolute bottom-4 left-4 right-4">
                     <h3 class="text-xl font-bold text-white mb-1 group-hover:text-green-400 transition">{{ $program->title }}</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ Str::limit(strip_tags($program->description), 120) }}</p>
                <div class="flex items-center text-blue-600 font-semibold text-sm group-hover:text-green-600 transition">
                    Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-gray-500">
            <i class="fas fa-graduation-cap text-4xl mb-4 text-gray-300"></i>
            <p>Belum ada data program yang ditambahkan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
