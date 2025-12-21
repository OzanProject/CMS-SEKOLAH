<!-- Facility Section -->
<div class="py-20 bg-gray-50 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]" id="facility">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-green-600 font-bold uppercase tracking-widest text-xs bg-green-100 px-3 py-1 rounded-full">Fasilitas Sekolah</span>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mt-4 leading-tight">Sarana Prasarana Modern</h2>
            <div class="w-24 h-1.5 bg-green-600 mx-auto mt-6 rounded-full opacity-80"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">
                Menunjang kegiatan belajar mengajar dengan fasilitas terbaik dan teknologi terkini.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($facilities as $facility)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 cursor-pointer" onclick="window.location='{{ route('facilities.show', $facility) }}'">
                <!-- Image Container -->
                <div class="relative h-48 overflow-hidden bg-gray-200">
                    @if($facility->image)
                        <img src="{{ asset('storage/'.$facility->image) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                         <!-- Fallback Pattern/Icon if no image -->
                        <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-green-50 to-green-100 text-green-300">
                            <i class="{{ $facility->icon ?? 'fas fa-building' }} text-6xl opacity-40 group-hover:scale-110 transition-transform duration-500"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Content -->
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600 mr-3 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                                <i class="{{ $facility->icon ?? 'fas fa-check' }} text-sm"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 group-hover:text-green-600 transition-colors">{{ $facility->name }}</h4>
                        </div>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">
                            {{ $facility->description ?? 'Deskripsi fasilitas sekolah yang menunjang pembelajaran siswa.' }}
                        </p>
                    </div>
                    <a href="{{ route('facilities.show', $facility) }}" class="inline-flex items-center text-sm font-bold text-green-600 hover:text-green-800 transition-colors group-hover:translate-x-1 duration-300">
                        Lihat Detail <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-12">
                <div class="inline-block p-4 rounded-full bg-gray-100 mb-3">
                    <i class="fas fa-box-open text-3xl text-gray-400"></i>
                </div>
                <p class="text-gray-500">Belum ada data fasilitas.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-16">
             <a href="{{ route('facilities.index') }}" class="inline-block px-8 py-3 bg-white border-2 border-green-600 text-green-700 font-bold rounded-full hover:bg-green-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-lg">
                Lihat Seluruh Fasilitas
             </a>
        </div>
    </div>
</div>
