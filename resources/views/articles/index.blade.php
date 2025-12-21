@extends('layouts.public')

@section('title', 'Berita & Artikel')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <ol class="list-reset flex text-xs md:text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-green-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-semibold">Berita & Artikel</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Main Content -->
        <div class="lg:col-span-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    @if(request('search'))
                        Hasil Pencarian: "{{ request('search') }}"
                    @elseif(request('category'))
                        Kategori: {{ ucwords(str_replace('-', ' ', request('category'))) }}
                    @else
                        Berita Terbaru
                    @endif
                </h1>
                
                @if(request('search') || request('category'))
                     <a href="{{ route('articles.index') }}" class="text-sm text-red-500 hover:text-red-700 mt-2 md:mt-0">
                        <i class="fas fa-times-circle mr-1"></i> Reset Filter
                     </a>
                @endif
            </div>

            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($articles as $article)
                    <div class="bg-white rounded-lg shadow border border-gray-100 overflow-hidden group hover:shadow-lg transition-all duration-300" data-aos="fade-up">
                        <div class="relative h-56 overflow-hidden">
                            @if($article->image)
                                <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-newspaper text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-0 left-0 bg-green-600 text-white text-xs font-bold px-3 py-1 m-3 rounded shadow">
                                {{ $article->categoryRel->name ?? $article->category ?? 'Berita' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-gray-400 text-xs mb-3">
                                <span class="mr-3"><i class="far fa-user mr-1"></i> {{ $article->author->name ?? 'Admin' }}</span>
                                <span><i class="far fa-clock mr-1"></i> {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                            </div>
                             <h2 class="text-lg font-bold text-gray-800 mb-3 leading-snug group-hover:text-green-600 transition">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-green-600 font-semibold text-sm hover:underline">
                                Baca Selengkapnya <i class="fas fa-long-arrow-alt-right ml-2 transition-transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $articles->links('pagination::tailwind') }}
                </div>
            @else
                <div class="text-center py-16 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <div class="inline-block p-4 rounded-full bg-white shadow-sm mb-4">
                        <i class="fas fa-search text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak Ditemukan</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Maaf, kami tidak dapat menemukan artikel yang Anda cari. Coba kata kunci lain atau reset filter.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Search Widget -->
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                <h4 class="font-bold text-gray-900 mb-4 text-lg">Cari Berita</h4>
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:outline-none focus:border-green-500 focus:bg-white transition" placeholder="Kata kunci...">
                        <div class="absolute left-0 top-0 h-full w-10 flex items-center justify-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Categories Widget -->
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                <h4 class="font-bold text-gray-900 mb-4 text-lg relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-green-600">
                    Kategori
                </h4>
                <div class="flex flex-col space-y-2">
                    @foreach($categories as $category)
                    <a href="{{ route('articles.index', ['category' => $category->slug]) }}" class="flex justify-between items-center group p-2 hover:bg-gray-50 rounded transition">
                        <span class="text-gray-600 group-hover:text-green-600 font-medium transition flex items-center">
                            <i class="fas fa-Folder border-r text-gray-300 mr-2 pr-2 text-xs"></i> 
                            {{ $category->name }}
                        </span>
                        <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full group-hover:bg-green-100 group-hover:text-green-600 transition">{{ $category->articles_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Ad: Sidebar Right (Using GlobalAds) -->
            @if(isset($globalAds['sidebar_right']) && $globalAds['sidebar_right']->isNotEmpty())
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 text-center">
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
            @endif

            <!-- Recent Posts Widget -->
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
                <h4 class="font-bold text-gray-900 mb-6 text-lg relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-blue-600">
                    Berita Populer
                </h4>
                <ul class="space-y-4">
                    @foreach($footerPopulerArticles as $populer)
                    <li class="flex items-start group">
                        <div class="w-20 h-16 bg-gray-200 rounded overflow-hidden flex-shrink-0 mr-4">
                            @if($populer->image)
                                <img src="{{ asset('storage/'.$populer->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                            @endif
                        </div>
                        <div>
                             <h5 class="text-sm font-bold text-gray-800 leading-snug group-hover:text-green-600 transition mb-1">
                                <a href="{{ route('articles.show', $populer->slug) }}">{{ $populer->title }}</a>
                            </h5>
                            <span class="text-xs text-gray-400"><i class="far fa-clock"></i> {{ $populer->published_at->format('d M Y') }}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            
        </div>
    </div>
</div>
@endsection
