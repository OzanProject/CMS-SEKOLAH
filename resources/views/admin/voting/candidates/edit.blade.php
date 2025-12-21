@extends('layouts.admin')

@section('header', 'Edit Kandidat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit Data Kandidat</h3>
            </div>
            <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Nama Kandidat</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $candidate->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>No. Urut</label>
                                <input type="number" name="nomor_urut" class="form-control" value="{{ old('nomor_urut', $candidate->nomor_urut) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Foto Kandidat</label>
                        @if($candidate->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$candidate->photo) }}" alt="Current Photo" style="height: 100px; border-radius: 5px;">
                            </div>
                        @endif
                        <div class="custom-file">
                             <input type="file" name="photo" class="custom-file-input" id="customFile">
                             <label class="custom-file-label" for="customFile">Ganti Foto (Opsional)</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Visi</label>
                        <textarea name="visi" class="form-control" rows="3">{{ old('visi', $candidate->visi) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Misi</label>
                        <textarea name="misi" class="form-control" rows="5">{{ old('misi', $candidate->misi) }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update Kandidat</button>
                    <a href="{{ route('admin.voting.show', $event->id) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush
@endsection
