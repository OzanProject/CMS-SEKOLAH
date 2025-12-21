<!-- Profile Section -->
<div class="bg-gray-50 py-16" id="profile">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
                <div class="border-l-4 border-green-600 pl-4 mb-6">
                     <span class="text-green-600 font-bold uppercase tracking-widest text-sm">Tentang Sekolah</span>
                     <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mt-2">Profil Sekolah</h2>
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    {!! $school_settings['school_description'] ?? 'Sekolah kami berkomitmen untuk mencetak generasi yang cerdas, berakhlak mulia, dan kompetitif di era global. Dengan fasilitas lengkap dan tenaga pengajar profesional, kami siap mengantarkan putra-putri Anda menuju masa depan yang gemilang.' !!}
                </p>
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-4 rounded shadow-sm border-l-4 border-blue-500">
                        <i class="fas fa-user-graduate text-3xl text-blue-500 mb-2"></i>
                        <h4 class="font-bold text-gray-800">1000+</h4>
                        <p class="text-sm text-gray-500">Siswa Berprestasi</p>
                    </div>
                    <div class="bg-white p-4 rounded shadow-sm border-l-4 border-yellow-500">
                         <i class="fas fa-chalkboard-teacher text-3xl text-yellow-500 mb-2"></i>
                        <h4 class="font-bold text-gray-800">50+</h4>
                        <p class="text-sm text-gray-500">Guru Profesional</p>
                    </div>
                </div>
                <a href="{{ route('public_profile.index') }}" class="inline-block border-2 border-green-600 text-green-600 font-bold px-6 py-2 rounded hover:bg-green-600 hover:text-white transition">Selengkapnya</a>
            </div>
            <div class="relative" data-aos="fade-left">
                <div class="absolute -top-4 -left-4 w-24 h-24 bg-green-100 rounded-full z-0"></div>
                <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-blue-100 rounded-full z-0"></div>
                 @if(isset($school_settings['school_profile_image']) && $school_settings['school_profile_image'])
                    <img src="{{ asset('storage/'.$school_settings['school_profile_image']) }}" class="relative z-10 w-full rounded-lg shadow-xl" alt="School Profile">
                @else
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="relative z-10 w-full rounded-lg shadow-xl" alt="Placeholder">
                @endif
            </div>
        </div>
    </div>
</div>
