@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Tentang Kami</h1>
            
            <div class="prose max-w-none text-gray-600">
                @if(isset($school_settings['page_about']) && $school_settings['page_about'])
                    {!! $school_settings['page_about'] !!}
                @else
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-info-circle text-4xl mb-4"></i>
                        <p>Konten "Tentang Kami" belum diisi di Pengaturan Admin.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
