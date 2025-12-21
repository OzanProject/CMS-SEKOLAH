@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Pesan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Pesan</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Baca Pesan</h3>
            </div>
            <div class="card-body p-0">
                <div class="mailbox-read-info">
                    <h5>{{ $message->name }}</h5>
                    <h6>Dari: {{ $message->email }}
                        <span class="mailbox-read-time float-right">{{ $message->created_at->format('d M Y H:i') }}</span>
                    </h6>
                    @if($message->phone)
                        <h6>Telp: {{ $message->phone }}</h6>
                    @endif
                </div>
                <div class="mailbox-read-message p-4">
                    <p>{{ $message->message }}</p>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.messages.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>
                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline float-right" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
