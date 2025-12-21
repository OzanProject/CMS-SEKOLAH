<!-- Program Section -->
<div class="py-16 bg-white" id="program">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-blue-600 font-bold uppercase tracking-widest text-sm">Akademik</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mt-2">Program Unggulan</h2>
            <div class="w-20 h-1 bg-blue-600 mx-auto mt-4 rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($programs as $program)
            <div class="bg-gray-50 rounded-lg overflow-hidden group hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="h-48 overflow-hidden relative">
                    @if($program->image)
                        <img src="{{ asset('storage/'.$program->image) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    @else
                        <img src="https://source.unsplash.com/random/400x300?education,tech&sig={{ $loop->index }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    @endif
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-transparent transition"></div>
                    <h3 class="absolute bottom-4 left-4 text-xl font-bold text-white">{{ $program->title }}</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($program->description), 100) }}</p>
                    <a href="{{ route('programs.show', $program) }}" class="text-blue-600 font-bold text-sm hover:underline">Detail Program <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada data program.</div>
            @endforelse
        </div>
    </div>
</div>
