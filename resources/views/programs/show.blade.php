@extends('layouts.public')

@section('title', $program->title)

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <ol class="list-reset flex text-xs md:text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-green-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('programs.index') }}" class="hover:text-green-600">Program</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-semibold">{{ $program->title }}</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Program Image -->
            <div class="relative h-[400px]">
                @if($program->image)
                    <img src="{{ asset('storage/'.$program->image) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                @else
                    <img src="https://source.unsplash.com/random/1200x800?education,learning&sig={{ $program->id }}" class="w-full h-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent flex items-end">
                    <div class="p-8 md:p-12 w-full">
                        <span class="inline-block bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded mb-3 uppercase tracking-wider shadow-sm">
                            Program Akademik
                        </span>
                        <h1 class="text-3xl md:text-5xl font-bold text-white mb-2 text-shadow-md leading-tight">{{ $program->title }}</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row gap-12">
                    <!-- Description -->
                    <div class="flex-1 prose prose-lg text-gray-700">
                         <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-blue-600 pl-4">Tentang Program</h3>
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 mb-6">
                            {!! $program->description !!}
                        </div>
                        
                        <h4 class="font-bold text-gray-900 mb-4">Keunggulan Program</h4>
                        <ul class="list-none space-y-2 mb-6">
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Kurikulum terstandarisasi</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Dibimbing pengajar ahli</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Fasilitas pendukung lengkap</li>
                        </ul>
                    </div>

                    <!-- Sidebar CTA -->
                    <div class="w-full md:w-80 space-y-6">
                        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 text-center shadow-lg">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-blue-600 shadow mx-auto mb-4">
                                <i class="fas fa-file-alt text-2xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Tertarik Program Ini?</h4>
                            <p class="text-sm text-gray-600 mb-6">Dapatkan informasi lebih lanjut mengenai pendaftaran dan detail program.</p>
                            <a href="{{ url('/') }}#contact" class="block w-full py-3 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition transform hover:-translate-y-1">
                                Hubungi Kami
                            </a>
                        </div>
                        
                         <div class="bg-gray-100 p-6 rounded-xl border border-gray-200">
                            <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Program Lainnya</h4>
                            <ul class="space-y-3">
                                @foreach(\App\Models\Program::where('id', '!=', $program->id)->take(5)->get() as $other)
                                <li>
                                    <a href="{{ route('programs.show', $other->id) }}" class="flex items-center text-gray-600 hover:text-blue-600 transition group">
                                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-blue-500"></i>
                                        <span class="text-sm font-medium">{{ $other->title }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
