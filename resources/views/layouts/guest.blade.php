<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | {{ $school_settings['school_name'] ?? config('app.name', 'MyPortal') }}</title>
    @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
        <link rel="icon" href="{{ asset('storage/'.$school_settings['school_logo']) }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased overflow-hidden">
    <div class="flex h-screen w-full">
        <!-- Left Side: Image & Branding -->
        <div class="hidden lg:flex w-1/2 xl:w-2/3 bg-green-900 relative items-center justify-center overflow-hidden">
            <!-- Background Image -->
            <img src="https://images.unsplash.com/photo-1596496356983-d38e7663d891?auto=format&fit=crop&q=80&w=2670&ixlib=rb-4.0.3" 
                 class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" 
                 alt="School Background">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-green-900/90 to-teal-900/80 z-10"></div>
            
            <!-- Content -->
            <div class="relative z-20 text-center px-10 max-w-2xl">
                @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
                    <img src="{{ asset('storage/'.$school_settings['school_logo']) }}" alt="Logo" class="h-32 w-auto mx-auto mb-8 drop-shadow-2xl">
                @else
                    <i class="fas fa-school text-white text-8xl mb-6 opacity-90"></i>
                @endif
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tight">
                    {{ $school_settings['school_name'] ?? 'Selamat Datang' }}
                </h1>
                <div class="text-green-100 text-lg md:text-xl font-light leading-relaxed">
                    {!! $school_settings['school_description'] ?? 'Portal integritas akademik dan manajemen sekolah masa depan.' !!}
                </div>
                
                <!-- Optional Quote or Footer on Image Side -->
                <div class="mt-12 pt-8 border-t border-white/20 text-white/60 text-sm">
                    &copy; {{ date('Y') }} {{ $school_settings['school_name'] ?? config('app.name') }}. All rights reserved.
                </div>
            </div>
            
            <!-- Abstract Shapes -->
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-yellow-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 left-0 w-64 h-64 bg-green-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 xl:w-1/3 flex items-center justify-center p-8 bg-white shadow-xl relative z-30">
            <div class="w-full max-w-md">
                <!-- Mobile Logo (Visible only on small screens) -->
                <div class="lg:hidden text-center mb-8">
                     @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
                        <img src="{{ asset('storage/'.$school_settings['school_logo']) }}" alt="Logo" class="h-16 w-auto mx-auto mb-4">
                    @else
                        <i class="fas fa-school text-green-700 text-5xl mb-4"></i>
                    @endif
                    <h2 class="text-2xl font-bold text-gray-800">{{ $school_settings['school_name'] ?? 'Portal Sekolah' }}</h2>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Login Akun</h2>
                    <p class="text-gray-500">Silakan masukkan identitas Anda untuk masuk.</p>
                </div>

                {{ $slot }}
                
                <div class="mt-10 text-center text-sm text-gray-400">
                    Butuh bantuan? <a href="#" class="text-green-700 hover:text-green-800 font-semibold">Hubungi Admin</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
