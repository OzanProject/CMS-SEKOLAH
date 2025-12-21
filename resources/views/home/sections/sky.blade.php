<!-- Sky Section (Latest Grid) -->
<div class="bg-sky-50 py-12 border-t border-gray-200" id="latest">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
             @foreach($gridNews as $gridItem)
             <div class="bg-white shadow-sm rounded overflow-hidden group hover:shadow-lg transition duration-300">
                 <div class="relative h-40 overflow-hidden">
                    @if($gridItem->image)
                        <img src="{{ asset('storage/'.$gridItem->image) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                    @endif
                    <div class="absolute bottom-3 left-3">
                         <span class="px-2 py-0.5 bg-blue-600 text-[10px] font-bold text-white uppercase rounded-sm">
                            {{ $gridItem->category ?? 'General' }}
                        </span>
                    </div>
                 </div>
                 <div class="p-4">
                     <div class="flex items-center text-[10px] text-gray-400 mb-2">
                        <span><i class="far fa-clock mr-1"></i> {{ $gridItem->published_at->translatedFormat('d M Y') }}</span>
                     </div>
                     <h6 class="font-bold text-gray-800 hover:text-blue-600 transition leading-snug line-clamp-2 text-sm">
                         <a href="{{ route('articles.show', $gridItem->slug) }}">{{ $gridItem->title }}</a>
                     </h6>
                 </div>
             </div>
             @endforeach
        </div>
    </div>
</div>
