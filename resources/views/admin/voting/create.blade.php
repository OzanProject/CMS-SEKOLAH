@extends('layouts.admin')

@section('header', 'Buat Event Voting')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Event Baru</h3>
    </div>
    <form action="{{ route('admin.voting.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nama Event</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Waktu Mulai</label>
                        <input type="datetime-local" name="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label>Waktu Selesai</label>
                        <input type="datetime-local" name="end_date" class="form-control" required>
                    </div>
                </div>
            </div>
             <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" class="custom-control-input" id="isActiveSwitch" name="is_active" value="1" checked>
                    <label class="custom-control-label" for="isActiveSwitch">Set Aktif Sekarang</label>
                </div>
             </div>
        </div>
        <div class="card-footer">
             <button type="submit" class="btn btn-primary">Buat Event</button>
             <a href="{{ route('admin.voting.index') }}" class="btn btn-default float-right">Batal</a>
        </div>
    </form>
</div>
@endsection
