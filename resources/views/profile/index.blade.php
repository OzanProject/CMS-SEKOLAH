@extends('layouts.public')

@section('title', 'Profil Sekolah')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <ol class="list-reset flex text-xs md:text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-green-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-semibold">Profil Sekolah</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">{{ $school_settings['school_name'] ?? 'Profil Sekolah' }}</h1>
        <div class="w-24 h-1 bg-green-600 mx-auto"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Main Content (Profile Details) -->
        <div class="lg:col-span-8 space-y-12">
            
            <!-- School Image -->
            <div class="relative rounded-xl overflow-hidden shadow-2xl mb-8">
                 @if(isset($school_settings['school_profile_image']) && $school_settings['school_profile_image'])
                    <img src="{{ asset('storage/'.$school_settings['school_profile_image']) }}" alt="School Profile" class="w-full h-auto">
                @else
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="School Profile" class="w-full h-auto">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                    <div class="p-8 text-white">
                        <h2 class="text-2xl font-bold mb-2">Unggul, Berkarakter, dan Berprestasi</h2>
                        <p class="text-white/80">Mencetak generasi emas yang siap menghadapi tantangan global.</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <section id="about" class="prose prose-lg max-w-none text-gray-700">
                <h3 class="text-2xl font-bold text-gray-900 mb-4 border-l-4 border-green-600 pl-4">Tentang Kami</h3>
                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    {!! $school_settings['school_description'] ?? 'Deskripsi sekolah belum diisi.' !!}
                </div>
            </section>

            <!-- Vision & Mission -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Vision -->
                 <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-blue-500 hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 text-blue-600">
                        <i class="fas fa-eye text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                    <div class="prose text-gray-700">
                        {!! $school_settings['school_vision'] ?? 'Visi belum diisi.' !!}
                    </div>
                </div>

                <!-- Mission -->
                <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-green-500 hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 text-green-600">
                        <i class="fas fa-bullseye text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                     <div class="prose text-gray-700">
                        @if(isset($school_settings['school_mission']))
                            <ul class="list-disc pl-5 space-y-2">
                                @foreach(explode(',', $school_settings['school_mission']) as $mission)
                                    <li>{{ trim(strip_tags($mission)) }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Misi belum diisi.</p>
                        @endif
                    </div>
                </div>
            </div>

             <!-- Headmaster Message -->
            <section class="bg-gradient-to-r from-gray-900 to-gray-800 text-white p-8 md:p-12 rounded-2xl shadow-xl flex flex-col md:flex-row items-center gap-8">
                <div class="w-32 h-32 md:w-48 md:h-48 flex-shrink-0 relative">
                     <div class="absolute inset-0 bg-green-500 rounded-full blur-lg opacity-50"></div>
                     <img src="https://ui-avatars.com/api/?name={{ urlencode($school_settings['school_principal'] ?? 'Kepala Sekolah') }}&background=10B981&color=fff&size=200" alt="Kepala Sekolah" class="w-full h-full object-cover rounded-full border-4 border-white relative z-10 shadow-lg">
                </div>
                <div>
                     <h3 class="text-2xl font-bold mb-2">Sambutan Kepala Sekolah</h3>
                     <p class="text-green-400 font-semibold mb-4">{{ $school_settings['school_principal'] ?? 'Kepala Sekolah' }}</p>
                     <blockquote class="italic text-gray-300 border-l-4 border-green-500 pl-4 py-2 bg-white/5 rounded-r">
                        "Pendidikan adalah kunci untuk membuka dunia, paspor untuk kebebasan."
                     </blockquote>
                     <div class="mt-4 text-sm text-gray-400">NIP. {{ $school_settings['school_principal_nip'] ?? '-' }}</div>
                </div>
            </section>
        </div>

        <!-- Sidebar (Info Box) -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Contact Info -->
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 sticky top-24">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-address-card text-green-600 mr-2"></i> Kontak Kami
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                         <div class="w-8 h-8 rounded bg-green-100 flex items-center justify-center text-green-600 mt-1 mr-3 flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                         </div>
                         <div class="flex-1 min-w-0">
                             <span class="block text-xs text-gray-500 font-bold uppercase tracking-wider">Alamat</span>
                             <span class="block text-gray-700 text-sm leading-snug break-words">{{ $school_settings['school_address'] ?? 'Alamat belum diisi' }}</span>
                         </div>
                    </li>
                    <li class="flex items-start">
                         <div class="w-8 h-8 rounded bg-blue-100 flex items-center justify-center text-blue-600 mt-1 mr-3 flex-shrink-0">
                            <i class="fas fa-phone-alt text-sm"></i>
                         </div>
                         <div class="flex-1 min-w-0">
                             <span class="block text-xs text-gray-500 font-bold uppercase tracking-wider">Telepon</span>
                             <span class="block text-gray-700 text-sm break-words">{{ $school_settings['school_phone'] ?? '-' }}</span>
                         </div>
                    </li>
                    <li class="flex items-start">
                         <div class="w-8 h-8 rounded bg-red-100 flex items-center justify-center text-red-600 mt-1 mr-3 flex-shrink-0">
                            <i class="fas fa-envelope text-sm"></i>
                         </div>
                         <div class="flex-1 min-w-0">
                             <span class="block text-xs text-gray-500 font-bold uppercase tracking-wider">Email</span>
                             <span class="block text-gray-700 text-sm break-words">{{ $school_settings['school_email'] ?? '-' }}</span>
                         </div>
                    </li>
                </ul>
                
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h4 class="font-bold text-gray-800 mb-4 text-sm">Ikuti Kami</h4>
                    <div class="flex space-x-3">
                        @if(isset($school_settings['facebook_url']))
                        <a href="{{ $school_settings['facebook_url'] }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition shadow-md"><i class="fab fa-facebook-f text-lg"></i></a>
                        @endif
                         @if(isset($school_settings['instagram_url']))
                        <a href="{{ $school_settings['instagram_url'] }}" target="_blank" class="w-10 h-10 rounded-full bg-pink-600 text-white flex items-center justify-center hover:bg-pink-700 transition shadow-md"><i class="fab fa-instagram text-xl"></i></a>
                        @endif
                        @if(isset($school_settings['youtube_url']))
                         <a href="{{ $school_settings['youtube_url'] }}" target="_blank" class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition shadow-md"><i class="fab fa-youtube text-lg"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Map -->
            @if(isset($school_settings['google_maps_url']))
            <div class="rounded-xl overflow-hidden shadow-lg h-60">
                 <iframe src="{{ $school_settings['google_maps_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
