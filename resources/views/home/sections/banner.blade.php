<!-- Banner Area -->
<div class="bg-black text-white pb-12">
    <!-- Hero Split -->
    <div class="container mx-auto px-4 pt-8 mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-8 banner-inner">
            @if($bannerFeature)
            <div class="mb-8 lg:mb-0">
                 <div class="relative h-[300px] lg:h-[400px] overflow-hidden rounded group">
                    @if($bannerFeature->image)
                        <img src="{{ asset('storage/'.$bannerFeature->image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Banner">
                    @else
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gray-600"></i>
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 uppercase rounded">{{ $bannerFeature->category ?? 'Utama' }}</span>
                 </div>
            </div>
            <div class="flex flex-col justify-center">
                <div class="flex items-center text-sm text-gray-400 mb-3 space-x-4">
                    <span class="bg-blue-600 text-white text-xs px-2 py-0.5 rounded">{{ $bannerFeature->category ?? 'Tech' }}</span>
                    <span><i class="far fa-clock mr-1"></i> {{ ($bannerFeature->published_at ?? $bannerFeature->created_at)->translatedFormat('d M Y') }}</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold leading-tight mb-4 hover:text-green-500 transition">
                    <a href="{{ route('articles.show', $bannerFeature->slug) }}">{{ $bannerFeature->title }}</a>
                </h2>
                <p class="text-gray-400 mb-6 line-clamp-3 leading-relaxed">
                    {!! Str::limit(strip_tags($bannerFeature->content), 150) !!}
                </p>
                <div>
                     <a href="{{ route('articles.show', $bannerFeature->slug) }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition shadow-lg hover:shadow-blue-500/50">Baca Selengkapnya</a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Banner Sub (4 Cards) -->
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($bannerSub as $sub)
            <div class="bg-gray-900 rounded-lg overflow-hidden group border border-gray-800 hover:border-gray-700 transition">
                <div class="relative h-48 overflow-hidden">
                    @if($sub->image)
                        <img src="{{ asset('storage/'.$sub->image) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Sub">
                    @else
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                            <i class="fas fa-image text-2xl text-gray-600"></i>
                        </div>
                    @endif
                    <span class="absolute top-2 left-2 bg-pink-600 text-white text-[10px] font-bold px-2 py-0.5 uppercase rounded">{{ $sub->category ?? 'News' }}</span>
                </div>
                <div class="p-4">
                    <h6 class="font-bold text-white mb-2 leading-snug hover:text-green-500 transition line-clamp-2">
                        <a href="{{ route('articles.show', $sub->slug) }}">{{ $sub->title }}</a>
                    </h6>
                    <div class="text-xs text-gray-500 flex items-center mt-2">
                        <i class="far fa-clock mr-1"></i> {{ ($sub->published_at ?? $sub->created_at)->translatedFormat('d M Y') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
