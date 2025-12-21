@extends('layouts.admin')

@section('header', 'Detail Kandidat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if($candidate->photo)
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('storage/'.$candidate->photo) }}"
                             alt="User profile picture" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                         <div class="d-inline-flex align-items-center justify-content-center bg-secondary rounded-circle" style="width: 150px; height: 150px; font-size: 50px;">
                            {{ $candidate->nomor_urut }}
                        </div>
                    @endif
                </div>

                <h3 class="profile-username text-center mt-3">{{ $candidate->name }}</h3>

                <p class="text-muted text-center">Nomor Urut: {{ $candidate->nomor_urut }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Total Suara</b> <a class="float-right badge badge-primary">{{ $candidate->votes_count ?? $candidate->votes()->count() }}</a>
                    </li>
                </ul>
                
                <div class="mb-3">
                    <strong><i class="fas fa-book mr-1"></i> Visi</strong>
                    <p class="text-muted">
                        {{ $candidate->visi ?? 'Belum diisi' }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong><i class="fas fa-list-alt mr-1"></i> Misi</strong>
                    <p class="text-muted">
                        {!! nl2br(e($candidate->misi ?? 'Belum diisi')) !!}
                    </p>
                </div>

                <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-warning btn-block"><b>Edit</b></a>
                <a href="{{ route('admin.voting.show', $event->id) }}" class="btn btn-secondary btn-block"><b>Kembali</b></a>
            </div>
        </div>
    </div>
</div>
@endsection
