<!-- Bottom Grid Section -->
<div class="py-12" id="grid">
     <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
             <!-- Reuse Loop for extra content -->
             @foreach($bottomGrid as $extra)
             <div class="group relative">
                 <div class="h-48 overflow-hidden rounded mb-3 relative">
                    @if($extra->image)
                        <img src="{{ asset('storage/'.$extra->image) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                    @endif
                     <a href="#" class="absolute top-2 left-2 bg-purple-600 text-white text-[10px] px-2 py-0.5 rounded font-bold uppercase hover:bg-purple-700 transition">{{ $extra->category ?? 'Tech' }}</a>
                 </div>
                 <div class="text-xs text-gray-500 mb-1"><i class="far fa-clock"></i> {{ $extra->published_at->translatedFormat('d M Y') }}</div>
                 <h6 class="font-bold text-gray-800 hover:text-purple-600 transition leading-snug line-clamp-2">
                     <a href="{{ route('articles.show', $extra->slug) }}">{{ $extra->title }}</a>
                 </h6>
             </div>
             @endforeach
        </div>
     </div>
</div>
