@extends('layouts.public')

@section('title', 'Disclaimer')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Disclaimer (Sanggahan)</h1>
            
            <div class="prose max-w-none text-gray-600 text-sm leading-relaxed">
                @if(isset($school_settings['page_disclaimer']) && $school_settings['page_disclaimer'])
                    {!! $school_settings['page_disclaimer'] !!}
                 @else
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                        <p>Konten "Disclaimer" belum diisi di Pengaturan Admin.</p>
                    </div>
                 @endif
            </div>
        </div>
    </div>
</div>
@endsection
