<div class="bg-gray-50 py-16" id="gallery">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Galeri Kegiatan</h2>
            <div class="w-20 h-1 bg-blue-600 mx-auto rounded"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Dokumentasi kegiatan terbaru siswa dan guru di lingkungan sekolah kami.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($galleries as $gallery)
            <div class="group relative aspect-square overflow-hidden rounded-lg cursor-pointer bg-gray-200">
                @if($gallery->image)
                    <img src="{{ asset('storage/'.$gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-full object-cover transition duration-500 group-hover:scale-110 filter brightness-100 group-hover:brightness-75"
                         onclick="openLightbox('{{ asset('storage/'.$gallery->image) }}', '{{ $gallery->title }}')">
                @else
                     <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-image text-3xl"></i>
                    </div>
                @endif
                
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 pointer-events-none">
                     <div class="text-center p-4">
                        <h6 class="text-white font-bold text-lg mb-1 drop-shadow-md">{{ $gallery->title }}</h6>
                        <p class="text-white/80 text-xs">{{ $gallery->content ?? '' }}</p>
                     </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-400">
                <i class="far fa-images text-4xl mb-3"></i>
                <p>Belum ada galeri foto.</p>
            </div>
            @endforelse
        </div>

        @if($galleries->count() > 0)
        <div class="text-center mt-10">
            <a href="{{ route('galleries.index') }}" class="inline-block border-2 border-blue-600 text-blue-600 font-bold px-8 py-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300">Lihat Semua Galeri</a>
        </div>
        @endif
    </div>
</div>

<!-- Simple Lightbox Modal using Alpine.js concept or Vanilla JS -->
<div id="lightbox" class="fixed inset-0 z-[9999] bg-black/90 hidden items-center justify-center p-4" onclick="closeLightbox()">
    <div class="relative max-w-5xl max-h-screen w-full flex flex-col items-center">
        <img id="lightbox-img" src="" class="max-w-full max-h-[85vh] object-contain rounded shadow-2xl">
        <p id="lightbox-caption" class="text-white mt-4 text-center font-medium text-lg"></p>
        <button class="absolute -top-10 right-0 text-white text-4xl hover:text-gray-300 active:scale-95 transition">&times;</button>
    </div>
</div>

<script>
    function openLightbox(src, caption) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').innerText = caption;
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
</script>
