@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

    <!-- Ad: Home Top -->
    @if(isset($globalAds['home_top']) && $globalAds['home_top']->isNotEmpty())
        <div class="container mx-auto px-4 py-4">
            @foreach($globalAds['home_top'] as $ad)
                @if($ad->type == 'image')
                    <a href="{{ $ad->url ?? '#' }}" target="_blank" rel="nofollow" class="block mb-4 last:mb-0">
                        <img src="{{ asset('storage/'.$ad->value) }}" alt="{{ $ad->title }}" class="w-full h-auto rounded shadow-sm">
                    </a>
                @else
                    <div class="mb-4 last:mb-0 text-center">{!! $ad->value !!}</div>
                @endif
            @endforeach
        </div>
    @endif

    @include('home.sections.banner')

    @include('home.sections.news')

    @include('home.sections.sky')

    @include('home.sections.bottom_grid')

    @include('home.sections.profile')

    @include('home.sections.program')

    @include('home.sections.facility')

    @include('home.sections.contact')

@endsection
