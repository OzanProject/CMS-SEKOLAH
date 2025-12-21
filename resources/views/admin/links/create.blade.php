@extends('layouts.admin')

@section('header', 'Tambah Link Layanan')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Link</h3>
            </div>
            <form action="{{ route('admin.links.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Judul Link</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Contoh: PPDB Online" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="url">URL Tujuan</label>
                        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" id="url" placeholder="https://... atau /voting/login" value="{{ old('url') }}" required>
                         @error('url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="mt-2 text-muted">
                            <small class="font-weight-bold"><i class="fas fa-magic"></i> Link Cepat (Pilih untuk mengisi otomatis):</small>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <button type="button" class="btn btn-outline-secondary btn-xs mr-1 mb-1 quick-link" data-url="{{ route('voting.login') }}">Voting OSIS</button>
                                    <button type="button" class="btn btn-outline-secondary btn-xs mr-1 mb-1 quick-link" data-url="{{ route('ppdb.index') }}">PPDB Online</button>
                                    <button type="button" class="btn btn-outline-secondary btn-xs mr-1 mb-1 quick-link" data-url="{{ route('articles.index') }}">Berita</button>
                                    <button type="button" class="btn btn-outline-secondary btn-xs mr-1 mb-1 quick-link" data-url="{{ url('/#contact') }}">Kontak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="target">Target Tab</label>
                        <select name="target" id="target" class="form-control">
                            <option value="_blank">Tab Baru (_blank)</option>
                            <option value="_self">Tab Sama (_self)</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.links.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.quick-link').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();
            const url = item.getAttribute('data-url');
            document.getElementById('url').value = url;
            
            // Subtle feedback
            item.classList.remove('btn-outline-secondary');
            item.classList.add('btn-secondary');
            setTimeout(() => {
                item.classList.add('btn-outline-secondary');
                item.classList.remove('btn-secondary');
            }, 200);
        });
    });
</script>
@endpush
