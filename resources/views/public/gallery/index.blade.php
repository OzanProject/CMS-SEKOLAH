@extends('layouts.public')

@section('title', 'Galeri Kegiatan')

@section('content')
    <!-- Header -->
    <div class="bg-blue-900 py-12 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="text-4xl font-extrabold mb-2">Galeri Kegiatan</h1>
            <p class="text-blue-200 text-lg">Dokumentasi aktivitas dan momen terbaik di sekolah kami.</p>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            
            @if($galleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($galleries as $gallery)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden group hover:shadow-xl transition duration-300">
                        <!-- Image Container -->
                        <div class="relative aspect-square overflow-hidden cursor-pointer bg-gray-200"
                             onclick="openLightbox('{{ asset('storage/'.$gallery->image) }}', '{{ $gallery->title }}')">
                            @if($gallery->image)
                                <img src="{{ asset('storage/'.$gallery->image) }}" 
                                     alt="{{ $gallery->title }}"
                                     class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-3xl"></i>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-4 border-t border-gray-100">
                            <h3 class="font-bold text-gray-800 text-lg mb-1 leading-snug line-clamp-1 group-hover:text-blue-600 transition">
                                {{ $gallery->title }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2">
                                {{ $gallery->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                            <div class="mt-3 text-xs text-gray-400 flex items-center">
                                <i class="far fa-calendar-alt mr-1"></i> {{ $gallery->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    {{ $galleries->links('pagination::tailwind') }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="inline-block p-6 rounded-full bg-gray-100 mb-4">
                        <i class="far fa-images text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700">Belum ada galeri</h3>
                    <p class="text-gray-500">Saat ini belum ada dokumentasi kegiatan yang diunggah.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-[9999] bg-black/95 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeLightbox(event)">
        <div class="relative max-w-6xl max-h-screen w-full flex flex-col items-center justify-center" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button class="absolute top-0 right-0 md:-right-8 -top-8 text-white text-4xl hover:text-gray-300 transition focus:outline-none" onclick="closeLightbox()">&times;</button>
            
            <!-- Image -->
            <img id="lightbox-img" src="" class="max-w-full max-h-[80vh] object-contain rounded shadow-2xl mb-4 border-4 border-white/10">
            
            <!-- Caption -->
            <div class="bg-black/50 px-6 py-3 rounded-full text-center backdrop-blur-md">
                <p id="lightbox-caption" class="text-white font-medium text-lg"></p>
            </div>
        </div>
    </div>

    <script>
        function openLightbox(src, caption) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const cap = document.getElementById('lightbox-caption');
            
            img.src = src;
            cap.innerText = caption;
            
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
            
            // Fade in effect
            lightbox.animate([
                { opacity: 0 },
                { opacity: 1 }
            ], {
                duration: 200,
                easing: 'ease-out'
            });
        }

        function closeLightbox(e = null) {
            // If e is passed (click event), make sure it's the background or close button
            const lightbox = document.getElementById('lightbox');
            
            // Fade out
            const animation = lightbox.animate([
                { opacity: 1 },
                { opacity: 0 }
            ], {
                duration: 200,
                easing: 'ease-in'
            });

            animation.onfinish = () => {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
                document.body.style.overflow = 'auto'; // Restore scrolling
            };
        }

        // Close on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeLightbox();
            }
        });
    </script>
@endsection
