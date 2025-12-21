@extends('layouts.public')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Kebijakan Privasi (Privacy Policy)</h1>
            
            <div class="prose max-w-none text-gray-600 text-sm leading-relaxed">
                @if(isset($school_settings['page_privacy']) && $school_settings['page_privacy'])
                    {!! $school_settings['page_privacy'] !!}
                @else
                     <p class="mb-4">Terakhir diperbarui: {{ date('d M Y') }}</p>
                     <p>Kebijakan Privasi standar untuk <strong>{{ $school_settings['school_name'] ?? 'Website' }}</strong> belum diatur penuh di admin. Namun secara umum kami menghargai privasi Anda.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
