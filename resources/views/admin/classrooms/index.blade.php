@extends('layouts.admin')

@section('header', 'Data Kelas')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Kelas Baru</h3>
            </div>
            <form action="{{ route('admin.classrooms.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: 7A, 8B" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Kelas</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kelas</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classrooms as $index => $class)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->students_count }} Siswa</td>
                            <td>
                                <form action="{{ route('admin.classrooms.destroy', $class->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini? Siswa di dalamnya ikut terhapus!');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data kelas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
