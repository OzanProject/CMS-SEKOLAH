@extends('layouts.admin')

@section('header', 'Manajemen E-Voting')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <a href="{{ route('admin.voting.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Buat Event Voting
        </a>
    </div>
</div>

<div class="row">
    @forelse($events as $event)
    <div class="col-md-4">
        <div class="card card-outline {{ $event->is_active ? 'card-success' : 'card-secondary' }}">
            <div class="card-header">
                <h3 class="card-title">{{ $event->title }}</h3>
                <div class="card-tools">
                    <span class="badge {{ $event->is_active ? 'badge-success' : 'badge-secondary' }}">
                        {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text text-muted">{{ Str::limit($event->description, 100) }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Mulai</b> <span class="float-right">{{ $event->start_date->format('d M Y H:i') }}</span>
                    </li>
                    <li class="list-group-item">
                        <b>Selesai</b> <span class="float-right">{{ $event->end_date->format('d M Y H:i') }}</span>
                    </li>
                </ul>
                <a href="{{ route('admin.voting.show', $event->id) }}" class="btn btn-block {{ $event->is_active ? 'btn-success' : 'btn-secondary' }} mb-2">
                    <i class="fas fa-cog"></i> Kelola (Kandidat & Token)
                </a>
                <form action="{{ route('admin.voting.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini? Semua data kandidat, token, dan suara akan hilang permanen.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-block btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Hapus Event
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Belum ada event voting. Silakan buat baru.
        </div>
    </div>
    @endforelse
</div>
@endsection
