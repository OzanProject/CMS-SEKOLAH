@extends('layouts.admin')

@section('header', 'Detail Artikel')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                     <i class="fas fa-newspaper mr-1"></i> Preview Artikel
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <!-- Title -->
                        <h2 class="font-weight-bold mb-3">{{ $article->title }}</h2>
                        
                        <!-- Meta Info -->
                        <div class="mb-4 text-muted">
                            <span class="mr-3"><i class="far fa-user"></i> {{ $article->author->name ?? 'Admin' }}</span>
                            <span class="mr-3"><i class="far fa-calendar-alt"></i> {{ $article->created_at->format('d M Y H:i') }}</span>
                            <span class="mr-3"><i class="far fa-folder"></i> {{ $article->categoryRel->name ?? $article->category }}</span>
                             <span class="badge {{ $article->status == 'published' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($article->status) }}</span>
                        </div>

                        <!-- Image -->
                        @if($article->image)
                            <img src="{{ asset('storage/'.$article->image) }}" class="img-fluid rounded mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $article->title }}">
                        @endif

                        <!-- Content -->
                        <div class="article-content border-top pt-4">
                            {!! $article->content !!}
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                         <div class="callout callout-info">
                            <h5>Informasi Tambahan</h5>
                            <p><strong>Slug:</strong><br> <small>{{ $article->slug }}</small></p>
                            <p><strong>Views:</strong><br> {{ $article->views ?? 0 }} kali dilihat</p>
                            <p><strong>Terakhir Update:</strong><br> {{ $article->updated_at->diffForHumans() }}</p>
                            
                            <hr>
                            <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="btn btn-primary btn-block btn-sm">
                                <i class="fas fa-external-link-alt"></i> Lihat di Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
