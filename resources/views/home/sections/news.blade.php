<!-- 4-Column Section (Trending | Latest | New | Join) -->
<div class="bg-white py-12" id="trending">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Trending News -->
            <div>
                <div class="border-l-4 border-red-500 pl-3 mb-6 flex justify-between items-center">
                    <h6 class="font-bold uppercase text-gray-800">Trending News</h6>
                </div>
                <!-- Simulating Carousel with just stack for now -->
                <div class="space-y-6">
                    @foreach($trending as $trend)
                    <div class="group relative">
                        <div class="relative h-48 overflow-hidden rounded mb-3">
                            @if($trend->image)
                                <img src="{{ asset('storage/'.$trend->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-3">
                                 <div class="text-xs text-white/80 mb-1"><i class="far fa-clock"></i> {{ ($trend->published_at ?? $trend->created_at)->translatedFormat('d M Y') }}</div>
                                 <h6 class="font-bold text-white hover:text-red-400 transition leading-tight line-clamp-2">
                                    <a href="{{ route('articles.show', $trend->slug) }}">{{ $trend->title }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Latest News (List Style) -->
            <div>
                <div class="border-l-4 border-purple-500 pl-3 mb-6">
                    <h6 class="font-bold uppercase text-gray-800">Latest News</h6>
                </div>
                <div class="space-y-4">
                    @foreach($latestList as $item)
                    <div class="flex items-start space-x-3 group border-b border-gray-100 pb-3 last:border-0">
                         <div class="w-20 h-16 flex-shrink-0 overflow-hidden rounded bg-gray-100">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fas fa-image text-xs"></i></div>
                            @endif
                         </div>
                         <div>
                             <div class="text-[10px] text-gray-400 mb-1"><i class="far fa-clock"></i> {{ ($item->published_at ?? $item->created_at)->translatedFormat('d M Y') }}</div>
                             <h6 class="text-sm font-semibold text-gray-800 hover:text-purple-600 leading-snug line-clamp-2">
                                 <a href="{{ route('articles.show', $item->slug) }}">{{ $item->title }}</a>
                             </h6>
                         </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- What's New -->
            <div>
                <div class="border-l-4 border-blue-500 pl-3 mb-6">
                    <h6 class="font-bold uppercase text-gray-800">What's New</h6>
                </div>
                <div class="space-y-6">
                    @foreach($whatsNew as $new)
                    <div class="group">
                        <div class="relative h-40 overflow-hidden rounded mb-3">
                            @if($new->image)
                                <img src="{{ asset('storage/'.$new->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                            @endif
                            <span class="absolute bottom-2 left-2 bg-blue-600 text-white text-[10px] px-2 py-0.5 rounded">{{ $new->category ?? 'Tech' }}</span>
                        </div>
                        <div class="flex items-center text-xs text-gray-400 mb-2">
                            <span class="mr-2"><i class="fas fa-user-circle"></i> Admin</span>
                            <span><i class="far fa-clock"></i> {{ $new->published_at->translatedFormat('d M Y') }}</span>
                        </div>
                        <h6 class="font-bold text-gray-800 hover:text-blue-500 transition leading-tight mb-2 line-clamp-2">
                            <a href="{{ route('articles.show', $new->slug) }}">{{ $new->title }}</a>
                        </h6>
                        <p class="text-xs text-gray-500 line-clamp-2">{{ Str::limit(strip_tags($new->content), 80) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Join Us -->
            <div>
                <div class="border-l-4 border-yellow-500 pl-3 mb-6">
                    <h6 class="font-bold uppercase text-gray-800">Join With Us</h6>
                </div>
                <div class="space-y-2 mb-6">
                    @if(isset($school_settings['facebook_url']) && $school_settings['facebook_url'])
                    <a href="{{ $school_settings['facebook_url'] }}" target="_blank" class="flex justify-between items-center bg-[#3b5999] text-white px-4 py-3 rounded hover:opacity-90 transition shadow-sm">
                        <span><i class="fab fa-facebook-f w-6"></i> Facebook</span>
                        <span class="text-xs font-bold bg-white/20 px-2 py-0.5 rounded">Like</span>
                    </a>
                    @endif
                    
                    @if(isset($school_settings['twitter_url']) && $school_settings['twitter_url'])
                    <a href="{{ $school_settings['twitter_url'] }}" target="_blank" class="flex justify-between items-center bg-[#55acee] text-white px-4 py-3 rounded hover:opacity-90 transition shadow-sm">
                        <span><i class="fab fa-twitter w-6"></i> Twitter</span>
                        <span class="text-xs font-bold bg-white/20 px-2 py-0.5 rounded">Follow</span>
                    </a>
                    @endif

                    @if(isset($school_settings['youtube_url']) && $school_settings['youtube_url'])
                    <a href="{{ $school_settings['youtube_url'] }}" target="_blank" class="flex justify-between items-center bg-[#cd201f] text-white px-4 py-3 rounded hover:opacity-90 transition shadow-sm">
                        <span><i class="fab fa-youtube w-6"></i> Youtube</span>
                        <span class="text-xs font-bold bg-white/20 px-2 py-0.5 rounded">Sub</span>
                    </a>
                    @endif

                    @if(isset($school_settings['instagram_url']) && $school_settings['instagram_url'])
                     <a href="{{ $school_settings['instagram_url'] }}" target="_blank" class="flex justify-between items-center bg-[#e4405f] text-white px-4 py-3 rounded hover:opacity-90 transition shadow-sm">
                        <span><i class="fab fa-instagram w-6"></i> Instagram</span>
                        <span class="text-xs font-bold bg-white/20 px-2 py-0.5 rounded">Follow</span>
                    </a>
                    @endif
                </div>
                <!-- Ad Placeholder -->
                <div class="w-full h-64 bg-gray-100 border border-gray-200 flex flex-col items-center justify-center text-gray-400 text-sm p-4 text-center rounded relative overflow-hidden">
                    <span class="z-10 font-bold uppercase tracking-wider">Iklan 300x250</span>
                    <i class="fas fa-ad text-4xl mt-2 opacity-20"></i>
                </div>
            </div>
        </div>
    </div>
</div>
