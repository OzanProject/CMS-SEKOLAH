@extends('layouts.public')

@section('title', $article->title)

@push('meta')
    <meta property="og:title" content="{{ $article->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($article->content), 150) }}" />
    @if($article->image)
    <meta property="og:image" content="{{ asset('storage/'.$article->image) }}" />
    @endif
    <meta property="og:url" content="{{ route('articles.show', $article->slug) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{ $school_settings['school_name'] ?? config('app.name') }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $article->title }}" />
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($article->content), 150) }}" />
    @if($article->image)
    <meta name="twitter:image" content="{{ asset('storage/'.$article->image) }}" />
    @endif
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <ol class="list-reset flex text-xs md:text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-green-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('articles.index') }}" class="hover:text-green-600">Berita</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-semibold truncate max-w-xs">{{ $article->title }}</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-8 lg:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Main Content (Left Column) -->
        <div class="lg:col-span-8">
            <!-- Article Header -->
            <div class="mb-8">
                <span class="inline-block bg-green-600 text-white text-xs font-bold px-3 py-1 rounded mb-4 uppercase tracking-wide">
                    {{ $article->category ?? 'Berita' }}
                </span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-4 text-shadow-sm">
                    {{ $article->title }}
                </h1>
                
                <div class="flex items-center text-gray-500 text-sm border-b border-gray-100 pb-6 mb-6">
                    <div class="flex items-center mr-6">
                         <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Admin') }}&background=random" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                         <span class="font-medium text-gray-800">{{ $article->author->name ?? 'Tim Redaksi' }}</span>
                    </div>
                    <div class="mr-6">
                        <i class="far fa-calendar-alt mr-1"></i> {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : $article->created_at->format('d M Y') }} WIB
                    </div>
                    <div>
                        <i class="far fa-eye mr-1"></i> {{ number_format($article->views) }} Views
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            @if($article->image)
            <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover">
                 @if($article->caption)
                <div class="bg-gray-100 p-2 text-xs text-gray-500 italic text-center">
                    {{ $article->caption }}
                </div>
                @endif
            </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed font-serif">
                <!-- Dropcap for first paragraph -->
                <style>
                    .prose p:first-of-type::first-letter {
                        float: left;
                        font-size: 3.5rem;
                        line-height: 0.8;
                        font-weight: bold;
                        color: #16a34a; /* green-600 */
                        margin-right: 0.5rem;
                    }
                </style>
            <!-- Ad: Home Top -->
    {!! $article->content !!}
            </div>

            <!-- Ad: Article Bottom -->
            @if(isset($globalAds['article_bottom']) && $globalAds['article_bottom']->isNotEmpty())
                <div class="my-8 text-center">
                    <span class="text-xs text-gray-400 uppercase tracking-widest mb-2 block">Advertisement</span>
                    @foreach($globalAds['article_bottom'] as $ad)
                        @if($ad->type == 'image')
                            <a href="{{ $ad->url ?? '#' }}" target="_blank" rel="nofollow" class="block mb-4 last:mb-0">
                                <img src="{{ asset('storage/'.$ad->value) }}" alt="{{ $ad->title }}" class="w-full h-auto rounded shadow-sm">
                            </a>
                        @else
                            <div class="mb-4 last:mb-0 overflow-hidden">{!! $ad->value !!}</div>
                        @endif
                    @endforeach
                </div>
            @endif

            <!-- Share Buttons Bottom -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h5 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wide">Bagikan Artikel Ini:</h5>
                <div class="flex flex-wrap gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article->slug)) }}" target="_blank" rel="noopener noreferrer" class="flex-1 min-w-[120px] py-3 bg-[#3b5999] text-white rounded text-center hover:opacity-90 transition font-bold text-sm shadow-sm md:flex-none md:w-auto px-4">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article->slug)) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener noreferrer" class="flex-1 min-w-[120px] py-3 bg-[#000000] text-white rounded text-center hover:opacity-90 transition font-bold text-sm shadow-sm md:flex-none md:w-auto px-4">
                        <i class="fab fa-x-twitter mr-2"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . route('articles.show', $article->slug)) }}" target="_blank" rel="noopener noreferrer" class="flex-1 min-w-[120px] py-3 bg-[#25D366] text-white rounded text-center hover:opacity-90 transition font-bold text-sm shadow-sm md:flex-none md:w-auto px-4">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('articles.show', $article->slug)) }}&title={{ urlencode($article->title) }}" target="_blank" rel="noopener noreferrer" class="flex-1 min-w-[120px] py-3 bg-[#0077b5] text-white rounded text-center hover:opacity-90 transition font-bold text-sm shadow-sm md:flex-none md:w-auto px-4">
                        <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                    </a>
                    <button onclick="copyLink('{{ route('articles.show', $article->slug) }}')" class="flex-1 min-w-[120px] py-3 bg-gray-600 text-white rounded text-center hover:opacity-90 transition font-bold text-sm shadow-sm md:flex-none md:w-auto px-4">
                        <i class="fas fa-link mr-2"></i> Salin Link
                    </button>
                </div>
            </div>

            <script>
                function copyLink(url) {
                    navigator.clipboard.writeText(url).then(function() {
                        // Use SweetAlert if available, otherwise standard alert
                        if(typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Link Disalin!',
                                text: 'Link artikel berhasil disalin ke clipboard.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            alert('Link berhasil disalin!');
                        }
                    }, function(err) {
                        console.error('Async: Could not copy text: ', err);
                    });
                }
            </script>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="mt-12 bg-gray-50 border border-gray-200 rounded-xl p-6 md:p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-l-4 border-green-600 pl-4">Berita Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                    <div class="group">
                        <div class="relative h-40 overflow-hidden rounded-lg mb-3">
                            @if($related->image)
                                <img src="{{ asset('storage/'.$related->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                            @endif
                        </div>
                        <div class="text-xs text-green-600 font-bold uppercase mb-1">{{ $related->category }}</div>
                        <h4 class="font-bold text-gray-800 leading-snug hover:text-green-600 transition line-clamp-2">
                             <a href="{{ route('articles.show', $related->slug) }}">{{ $related->title }}</a>
                        </h4>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar (Right Column) -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Widget: Search -->
            <div class="bg-gray-100 p-6 rounded-lg">
                <form action="{{ route('articles.index') }}" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Cari berita..." class="w-full pl-4 pr-10 py-3 rounded border border-gray-300 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                    <button type="submit" class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-green-600">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Widget: Popular News (Global Shared) -->
            <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
                <h4 class="text-lg font-bold text-gray-900 mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-green-600">
                    Berita Populer
                </h4>
                <div class="space-y-4">
                    @foreach($footerPopulerArticles as $populer)
                    <div class="flex space-x-4 group">
                        <div class="w-20 h-20 flex-shrink-0 rounded overflow-hidden relative">
                             <span class="absolute top-0 left-0 bg-black/50 text-white w-6 h-6 flex items-center justify-center text-xs font-bold">{{ $loop->iteration }}</span>
                             @if($populer->image)
                                <img src="{{ asset('storage/'.$populer->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                            @endif
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 mb-1"><i class="far fa-clock"></i> {{ $populer->published_at ? $populer->published_at->format('d M Y') : $populer->created_at->format('d M Y') }}</div>
                            <h5 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-green-600 transition line-clamp-2">
                                <a href="{{ route('articles.show', $populer->slug) }}">{{ $populer->title }}</a>
                            </h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

             <!-- Widget: Ad Placeholder -->
             <!-- Widget: Ad Placeholder -->
             @if(isset($globalAds['sidebar_right']) && $globalAds['sidebar_right']->isNotEmpty())
                <div class="w-full bg-white border border-gray-200 p-4 rounded mb-8 text-center">
                     <span class="text-xs text-gray-400 uppercase tracking-widest mb-2 block">Advertisement</span>
                     @foreach($globalAds['sidebar_right'] as $ad)
                        @if($ad->type == 'image')
                            <a href="{{ $ad->url ?? '#' }}" target="_blank" rel="nofollow" class="block mb-4 last:mb-0">
                                <img src="{{ asset('storage/'.$ad->value) }}" alt="{{ $ad->title }}" class="w-full h-auto rounded">
                            </a>
                        @else
                            <div class="mb-4 last:mb-0 overflow-hidden">{!! $ad->value !!}</div>
                        @endif
                    @endforeach
                </div>
             @else
                 <div class="w-full bg-gray-100 border border-gray-200 h-64 flex flex-col items-center justify-center text-center p-4 rounded text-gray-400 mb-8">
                    <span class="text-xs uppercase font-bold tracking-widest mb-2">Space Iklan</span>
                    <i class="fas fa-ad text-3xl opacity-20"></i>
                    <p class="text-xs mt-2">Hubungi kami untuk pasang iklan</p>
                 </div>
             @endif

            <!-- Widget: Recent Posts -->
            <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
                <h4 class="text-lg font-bold text-gray-900 mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-blue-600">
                    Terbaru
                </h4>
                <ul class="space-y-4">
                    @foreach($recentArticles as $recent)
                    <li class="border-b border-gray-100 pb-2 last:border-0 last:pb-0 group">
                        <a href="{{ route('articles.show', $recent->slug) }}" class="block font-semibold text-gray-700 hover:text-blue-600 transition text-sm mb-1">
                            <i class="fas fa-angle-right text-xs text-blue-500 mr-2 group-hover:translate-x-1 transition"></i> {{ $recent->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Widget: Categories (Static for now, could be dynamic) -->
            <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
                 <h4 class="text-lg font-bold text-gray-900 mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-purple-600">
                    Kategori
                </h4>
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-1 bg-gray-100 hover:bg-purple-600 hover:text-white text-gray-600 text-xs rounded transition uppercase">Berita</a>
                    <a href="#" class="px-3 py-1 bg-gray-100 hover:bg-purple-600 hover:text-white text-gray-600 text-xs rounded transition uppercase">Prestasi</a>
                    <a href="#" class="px-3 py-1 bg-gray-100 hover:bg-purple-600 hover:text-white text-gray-600 text-xs rounded transition uppercase">Agenda</a>
                    <a href="#" class="px-3 py-1 bg-gray-100 hover:bg-purple-600 hover:text-white text-gray-600 text-xs rounded transition uppercase">Ekstra</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
