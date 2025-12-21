<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $school_settings['school_description'] ?? 'Website Resmi Sekolah' }}">
    <meta name="keywords" content="{{ $school_settings['school_name'] ?? 'Sekolah' }}, Pendidikan, Sekolah Islam, Technology">
    <meta name="author" content="{{ $school_settings['school_name'] ?? 'MyPortal' }}">

    <title>@yield('title', 'Beranda') | {{ $school_settings['school_name'] ?? config('app.name', 'MyPortal') }}</title>
    @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
        <link rel="icon" href="{{ asset('storage/'.$school_settings['school_logo']) }}" type="image/x-icon">
    @endif

    <!-- Dynamic Meta Tags -->
    @stack('meta')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
      :root {
        --primary-color: #2e7d32;
        --secondary-color: #1b5e20;
        --accent-color: #4caf50;
      }

      body {
        font-family: "Segoe UI", system-ui, sans-serif;
      }

      .btn-primary {
        background-color: var(--primary-color);
        color: white;
        transition: all 0.3s ease;
      }

      .btn-primary:hover {
        background-color: var(--secondary-color);
      }

      .bg-primary {
        background-color: var(--primary-color);
      }
      
      .text-primary {
        color: var(--primary-color);
      }

      .section-divider {
        width: 100px;
        height: 3px;
        background: var(--accent-color);
        margin: 1.5rem auto;
      }
      
      /* Additional custom styles from template */
      .hero-slider {
        position: relative;
        overflow: hidden;
      }
      
      /* Mobile Menu Transition */
      #mobile-menu {
          transition: all 0.3s ease-in-out;
      }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-white">
    
    <!-- Ad: Header Top -->
    @if(isset($globalAds['header_top']) && $globalAds['header_top']->isNotEmpty())
        <div class="bg-gray-100 py-2 text-center border-b border-gray-200">
            <div class="container mx-auto px-4">
                @foreach($globalAds['header_top'] as $ad)
                    @if($ad->type == 'image')
                        <a href="{{ $ad->url ?? '#' }}" target="_blank" rel="nofollow">
                            <img src="{{ asset('storage/'.$ad->value) }}" alt="{{ $ad->title }}" class="mx-auto max-h-24 md:max-h-32 w-auto object-contain">
                        </a>
                    @else
                        <div class="mx-auto flex justify-center">{!! $ad->value !!}</div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Topbar -->
    <div class="bg-gray-100 border-b border-gray-200 hidden md:block">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between items-center text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <span><i class="fas fa-calendar-alt mr-2"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                    <a href="{{ route('pages.about') }}" class="hover:text-green-600">{{ __('Redaksi') }}</a>
                    <a href="{{ url('/') }}#contact" class="hover:text-green-600">{{ __('Iklan') }}</a>
                    <a href="{{ url('/') }}#contact" class="hover:text-green-600">{{ __('Kontak') }}</a>
                </div>
                <div class="flex items-center space-x-4">
                    @if(isset($school_settings['facebook_url']))
                        <a href="{{ $school_settings['facebook_url'] }}" class="hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(isset($school_settings['instagram_url']))
                        <a href="{{ $school_settings['instagram_url'] }}" class="hover:text-pink-600"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(isset($school_settings['youtube_url']))
                        <a href="{{ $school_settings['youtube_url'] }}" class="hover:text-red-600"><i class="fab fa-youtube"></i></a>
                    @endif
                    {{-- Hidden Login for Public
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="font-bold text-green-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-green-600">Login</a>
                    @endauth
                    --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Adbar / Logo Area -->
    <div class="bg-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center mb-4 md:mb-0">
                    @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
                        <img src="{{ asset('storage/'.$school_settings['school_logo']) }}" alt="Logo" class="h-16 w-auto object-contain mr-4">
                    @else
                        <i class="fas fa-school text-green-600 text-5xl mr-4"></i>
                    @endif
                    <div class="text-left">
                        <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">{{ $school_settings['school_name'] ?? 'MYPORTAL SEKOLAH' }}</h1>
                        <p class="text-sm text-gray-500 uppercase tracking-widest">Portal Berita & Informasi Sekolah</p>
                    </div>
                </a>
                
                <!-- Ad Space (Placeholder) -->
                <!-- Ad Space / Banner Sekolah -->
                <div class="hidden md:block w-1/2">
                    @if(isset($globalAds['header_logo_side']) && $globalAds['header_logo_side']->isNotEmpty())
                        @foreach($globalAds['header_logo_side'] as $ad)
                            @if($ad->type == 'image')
                                <a href="{{ $ad->url ?? '#' }}" target="_blank" rel="nofollow" class="block h-24 flex items-center justify-end">
                                    <img src="{{ asset('storage/'.$ad->value) }}" alt="{{ $ad->title }}" class="h-full w-auto object-contain rounded">
                                </a>
                            @else
                                <div class="h-24 flex items-center justify-end overflow-hidden">{!! $ad->value !!}</div>
                            @endif
                        @endforeach
                    @else
                        <div class="h-20 bg-gray-50 rounded flex items-center justify-center border border-gray-100 border-dashed">
                            <span class="text-gray-400 text-xs uppercase tracking-widest">{{ __('Space Iklan / Banner') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-black text-white sticky top-0 z-50 animate__animated animate__fadeInDown">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                 <!-- Mobile Menu Button -->
                 <div class="md:hidden py-3">
                    <button id="menu-toggle" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-1 uppercase text-sm font-semibold">
                    <a href="{{ url('/') }}" class="bg-green-700 px-4 py-4 hover:bg-green-600 transition duration-300">{{ __('Beranda') }}</a>
                    <a href="{{ url('/') }}#trending" class="px-4 py-4 hover:bg-gray-800 hover:text-green-500 transition duration-300">{{ __('Trending') }}</a>
                    <a href="{{ url('/') }}#latest" class="px-4 py-4 hover:bg-gray-800 hover:text-green-500 transition duration-300">{{ __('Terbaru') }}</a>
                    <a href="{{ url('/') }}#grid" class="px-4 py-4 hover:bg-gray-800 hover:text-green-500 transition duration-300">{{ __('Berita') }}</a>
                    <a href="{{ url('/') }}#profile" class="px-4 py-4 hover:bg-gray-800 hover:text-green-500 transition duration-300">{{ __('Profil') }}</a>
                    <a href="{{ url('/') }}#program" class="px-4 py-4 hover:bg-gray-800 hover:text-green-500 transition duration-300">{{ __('Program') }}</a>
                    <a href="{{ url('/') }}#facility" class="px-4 py-4 hover:bg-gray-800 hover:text-green-500 transition duration-300">{{ __('Fasilitas') }}</a>
                    <a href="{{ url('/') }}#contact" class="px-4 py-4 hover:bg-gray-800 hover:text-green-500 transition duration-300">{{ __('Kontak') }}</a>
                </div>

                <!-- Search Form -->
                <div class="hidden md:block">
                     <form action="{{ route('articles.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" placeholder="{{ __('Cari...') }}" class="bg-gray-800 text-white text-sm rounded-l px-3 py-1 focus:outline-none focus:bg-gray-700 w-32 transition-all duration-300 focus:w-48">
                        <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded-r hover:bg-green-600 transition"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu (Hidden by default) -->
         <div id="mobile-menu" class="hidden md:hidden bg-gray-900 border-t border-gray-800">
            <a href="{{ url('/') }}" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-800 text-green-500">{{ strtoupper(__('Beranda')) }}</a>
            <a href="{{ url('/') }}#trending" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-800">{{ strtoupper(__('Trending')) }}</a>
            <a href="{{ url('/') }}#latest" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-800">{{ strtoupper(__('Terbaru')) }}</a>
             <a href="{{ url('/') }}#profile" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-800">{{ strtoupper(__('Profil')) }}</a>
            <a href="{{ url('/') }}#program" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-800">{{ strtoupper(__('Program')) }}</a>
             <a href="{{ url('/') }}#contact" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-800">{{ strtoupper(__('Kontak')) }}</a>
        </div>
    </nav>

    <!-- JavaScript Toggle Menu Mobile -->
    <script>
      document.getElementById("menu-toggle").addEventListener("click", function () {
          const mobileMenu = document.getElementById("mobile-menu");
          mobileMenu.classList.toggle("hidden");
        });
    </script>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-gray-400 py-12 border-t-4 border-green-600">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- About -->
          <div>
            <h5 class="text-white font-bold text-lg mb-6 uppercase tracking-wider relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-green-600">{{ __('Tentang Sekolah') }}</h5>
             <div class="mb-4">
                @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
                    <img src="{{ asset('storage/'.$school_settings['school_logo']) }}" alt="Logo" class="h-10 w-auto bg-white p-1 rounded">
                @endif
             </div>
            <p class="text-sm leading-relaxed mb-4">
              {{ Str::limit(strip_tags($school_settings['school_description'] ?? 'Lembaga pendidikan berkualitas yang berkomitmen mencetak generasi unggul.'), 150) }}
            </p>
             <div class="flex space-x-2">
                @if(isset($school_settings['facebook_url']))
                 <a href="{{ $school_settings['facebook_url'] }}" class="w-8 h-8 flex items-center justify-center bg-gray-800 hover:bg-blue-600 text-white rounded transition"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(isset($school_settings['instagram_url']))
                 <a href="{{ $school_settings['instagram_url'] }}" class="w-8 h-8 flex items-center justify-center bg-gray-800 hover:bg-pink-600 text-white rounded transition"><i class="fab fa-instagram"></i></a>
                @endif
                @if(isset($school_settings['youtube_url']))
                 <a href="{{ $school_settings['youtube_url'] }}" class="w-8 h-8 flex items-center justify-center bg-gray-800 hover:bg-red-600 text-white rounded transition"><i class="fab fa-youtube"></i></a>
                @endif
            </div>
          </div>

          <!-- Digital Services -->
          <div>
            <h5 class="text-white font-bold text-lg mb-6 uppercase tracking-wider relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-green-600">{{ __('Layanan Digital') }}</h5>
            <div class="flex flex-col space-y-2">
                @if(isset($footer_links) && count($footer_links) > 0)
                    @foreach($footer_links as $link)
                        <a href="{{ $link->url }}" target="{{ $link->target }}" class="text-gray-400 hover:text-green-500 transition flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-green-600"></i> {{ $link->title }}
                        </a>
                    @endforeach
                @else
                    <span class="text-gray-500 text-sm">Belum ada layanan digital.</span>
                @endif
            </div>
          </div>

          <!-- Contacts -->
          <div>
            <h5 class="text-white font-bold text-lg mb-6 uppercase tracking-wider relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-green-600">{{ __('Hubungi Kami') }}</h5>
            <ul class="space-y-4 text-sm">
                <li class="flex items-start">
                    <i class="fas fa-map-marker-alt mt-1 mr-3 text-green-500"></i>
                    <span>{{ $school_settings['school_address'] ?? 'Jalan Pendidikan No. 1' }}</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-phone mr-3 text-green-500"></i>
                    <span>{{ $school_settings['school_phone'] ?? '+62 123 4567 890' }}</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-envelope mr-3 text-green-500"></i>
                    <span>{{ $school_settings['school_email'] ?? 'info@sekolah.sch.id' }}</span>
                </li>
            </ul>
          </div>

          <!-- Popular News -->
          <div>
             <h5 class="text-white font-bold text-lg mb-6 uppercase tracking-wider relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-green-600">{{ __('Populer') }}</h5>
             <div class="space-y-4">
                 @foreach($footerPopulerArticles as $article)
                 <div class="flex space-x-4 group cursor-pointer">
                     <div class="w-16 h-16 bg-gray-800 flex-shrink-0 overflow-hidden">
                        @if($article->image)
                            <img src="{{ asset('storage/'.$article->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gray-700 flex items-center justify-center text-gray-500">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                     </div>
                     <div>
                         <div class="text-xs text-green-500 mb-1"><i class="far fa-clock"></i> {{ $article->published_at->translatedFormat('d M Y') }}</div>
                         <h6 class="text-sm font-semibold text-white group-hover:text-green-500 leading-tight line-clamp-2">
                             <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                         </h6>
                     </div>
                 </div>
                 @endforeach
             </div>
          </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
            <div class="mb-4 md:mb-0">
                &copy; {{ date('Y') }} <span class="text-white">{{ $school_settings['school_name'] ?? 'MyPortal' }}</span>. All Rights Reserved.
            </div>
            <div class="flex space-x-6">
                <a href="{{ route('pages.about') }}" class="hover:text-green-500">{{ __('Tentang') }}</a>
                <a href="{{ route('pages.privacy') }}" class="hover:text-green-500">{{ __('Privasi') }}</a>
                <a href="{{ route('pages.disclaimer') }}" class="hover:text-green-500">{{ __('Disclaimer') }}</a>
                <a href="{{ url('/') }}#contact" class="hover:text-green-500">{{ __('Kontak') }}</a>
            </div>
        </div>
      </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-green-600 text-white w-10 h-10 rounded flex items-center justify-center shadow-lg opacity-0 invisible transition-all duration-300 z-50 hover:bg-green-700">
      <i class="fas fa-angle-up"></i>
    </button>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 800, 
        once: true, 
      });

       // Back to Top Button
      const backToTopBtn = document.getElementById("backToTop");
      window.addEventListener("scroll", () => {
        if (window.pageYOffset > 300) {
          backToTopBtn.classList.remove("opacity-0", "invisible");
        } else {
          backToTopBtn.classList.add("opacity-0", "invisible");
        }
      });
      backToTopBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });

      // Scroll Spy for Navigation Active State
      document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll("div[id]");
        const navLinks = document.querySelectorAll(".hidden.md\\:flex a[href*='#']");
        
        window.addEventListener("scroll", () => {
          let current = "";
          const scrollPosition = window.scrollY + 100; // Offset for header

          sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollPosition >= sectionTop) {
              current = section.getAttribute("id");
            }
          });

          // Special case for 'Home' / top of page
          if(window.scrollY < 100) {
              current = ""; // No hash, meaning Home
          }

          navLinks.forEach((link) => {
            link.classList.remove("text-green-500", "bg-gray-800");
            link.classList.add("bg-transparent"); // Reset background
            if (current && link.getAttribute("href").includes("#" + current)) {
                link.classList.add("text-green-500", "bg-gray-800");
                link.classList.remove("bg-transparent");
            } else if (!current && link.getAttribute("href") == "{{ url('/') }}") {
                // Home link active
                link.classList.add("bg-green-700");
                link.classList.remove("text-green-500", "bg-gray-800");
            } else {
                 // Reset home link if not active
                 if(link.getAttribute("href") == "{{ url('/') }}") {
                     link.classList.remove("bg-green-700");
                 }
            }
          });
        });
      });
    </script>
</body>
</html>
