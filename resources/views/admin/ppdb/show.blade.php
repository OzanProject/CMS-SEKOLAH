@extends('layouts.admin')

@section('header', 'Detail Pendaftaran')

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image / Status -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <div class="bg-gray-light d-flex justify-content-center align-items-center rounded-circle mx-auto mb-3" style="width: 100px; height: 100px; font-size: 40px; color: #555;">
                        {{ strtoupper(substr($registration->nama_lengkap, 0, 1)) }}
                    </div>
                </div>

                <h3 class="profile-username text-center">{{ $registration->nama_lengkap }}</h3>
                <p class="text-muted text-center">{{ $registration->nomor_pendaftaran }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Status</b> 
                        <a class="float-right">
                            <span class="badge {{ $registration->status === 'diterima' ? 'badge-success' : ($registration->status === 'ditolak' ? 'badge-danger' : 'badge-warning') }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>NISN</b> <a class="float-right">{{ $registration->nisn }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tanggal Daftar</b> <a class="float-right">{{ $registration->created_at->format('d M Y') }}</a>
                    </li>
                </ul>

                <!-- Action Buttons -->
                <button type="button" class="btn btn-success btn-block" onclick="confirmStatus('diterima')"><b><i class="fas fa-check"></i> Terima Siswa</b></button>
                <button type="button" class="btn btn-danger btn-block" onclick="confirmStatus('ditolak')"><b><i class="fas fa-times"></i> Tolak Siswa</b></button>

                <!-- Hidden Form -->
                <form id="statusForm" action="{{ route('admin.ppdb.updateStatus', $registration->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" id="inputStatus">
                    <input type="hidden" name="catatan" id="inputCatatan">
                </form>

                @if($registration->catatan)
                <div class="alert alert-info mt-3">
                    <strong>Catatan:</strong><br>
                    {{ $registration->catatan }}
                </div>
                @endif
            </div>
        </div>
        
        <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary btn-block mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#data-diri" data-toggle="tab">Data Diri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ortu" data-toggle="tab">Orang Tua/Wali</a></li>
                    <li class="nav-item"><a class="nav-link" href="#berkas" data-toggle="tab">Berkas</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    
                    <!-- Tab Data Diri -->
                    <div class="active tab-pane" id="data-diri">
                        <h5 class="text-primary mb-3 border-bottom pb-2"><i class="fas fa-user"></i> Identitas Siswa</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <dl>
                                    <dt>Nama Lengkap</dt>
                                    <dd>{{ $registration->nama_lengkap }}</dd>
                                    
                                    <dt>NIK</dt>
                                    <dd>{{ $registration->nik ?? '-' }}</dd>
                                    
                                    <dt>NISN</dt>
                                    <dd>{{ $registration->nisn }}</dd>

                                    <dt>Tempat, Tanggal Lahir</dt>
                                    <dd>{{ $registration->tempat_lahir }}, {{ $registration->tanggal_lahir->format('d F Y') }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt>Jenis Kelamin</dt>
                                    <dd>{{ $registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>

                                    <dt>Agama</dt>
                                    <dd>{{ $registration->agama ?? '-' }}</dd>

                                    <dt>Asal Sekolah</dt>
                                    <dd>{{ $registration->asal_sekolah }}</dd>
                                    
                                    <dt>No. Handphone</dt>
                                    <dd>{{ $registration->no_hp }}</dd>
                                </dl>
                            </div>
                        </div>

                        <h5 class="text-primary mt-4 mb-3 border-bottom pb-2"><i class="fas fa-map-marker-alt"></i> Alamat Domisili</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead" style="font-size: 16px;">
                                    {{ $registration->alamat }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <dt>RT / RW</dt>
                                <dd>{{ $registration->rt ?? '0' }} / {{ $registration->rw ?? '0' }}</dd>
                            </div>
                            <div class="col-md-4">
                                <dt>Desa / Kelurahan</dt>
                                <dd>{{ $registration->desa ?? '-' }}</dd>
                            </div>
                            <div class="col-md-4">
                                <dt>Kecamatan</dt>
                                <dd>{{ $registration->kecamatan ?? '-' }}</dd>
                            </div>
                            <div class="col-md-4">
                                <dt>Kabupaten / Kota</dt>
                                <dd>{{ $registration->kabupaten ?? '-' }}</dd>
                            </div>
                            <div class="col-md-4">
                                <dt>Provinsi</dt>
                                <dd>{{ $registration->provinsi ?? '-' }}</dd>
                            </div>
                            <div class="col-md-4">
                                <dt>Kode Pos</dt>
                                <dd>{{ $registration->kode_pos ?? '-' }}</dd>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Orang Tua -->
                    <div class="tab-pane" id="ortu">
                        <div class="row">
                            <!-- Ayah -->
                            <div class="col-md-6">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-male"></i> Data Ayah</h3>
                                    </div>
                                    <div class="card-body">
                                        <dl>
                                            <dt>Nama</dt>
                                            <dd>{{ $registration->nama_ayah }}</dd>
                                            <dt>NIK</dt>
                                            <dd>{{ $registration->nik_ayah ?? '-' }}</dd>
                                            <dt>Tahun Lahir</dt>
                                            <dd>{{ $registration->tahun_lahir_ayah ?? '-' }}</dd>
                                            <dt>Pendidikan</dt>
                                            <dd>{{ $registration->pendidikan_ayah ?? '-' }}</dd>
                                            <dt>Pekerjaan</dt>
                                            <dd>{{ $registration->pekerjaan_ayah }}</dd>
                                            <dt>Penghasilan</dt>
                                            <dd>{{ $registration->penghasilan_ayah ?? '-' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ibu -->
                            <div class="col-md-6">
                                <div class="card card-outline card-pink" style="border-top-color: #e83e8c;">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-female"></i> Data Ibu</h3>
                                    </div>
                                    <div class="card-body">
                                         <dl>
                                            <dt>Nama</dt>
                                            <dd>{{ $registration->nama_ibu }}</dd>
                                            <dt>NIK</dt>
                                            <dd>{{ $registration->nik_ibu ?? '-' }}</dd>
                                            <dt>Tahun Lahir</dt>
                                            <dd>{{ $registration->tahun_lahir_ibu ?? '-' }}</dd>
                                            <dt>Pendidikan</dt>
                                            <dd>{{ $registration->pendidikan_ibu ?? '-' }}</dd>
                                            <dt>Pekerjaan</dt>
                                            <dd>{{ $registration->pekerjaan_ibu }}</dd>
                                            <dt>Penghasilan</dt>
                                            <dd>{{ $registration->penghasilan_ibu ?? '-' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                             <!-- Wali -->
                             @if($registration->nama_wali)
                             <div class="col-md-12">
                                <div class="card card-outline card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-user-friends"></i> Data Wali</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <dt>Nama Wali</dt>
                                                <dd>{{ $registration->nama_wali }}</dd>
                                            </div>
                                            <div class="col-md-4">
                                                 <dt>NIK Wali</dt>
                                                <dd>{{ $registration->nik_wali ?? '-' }}</dd>
                                            </div>
                                            <div class="col-md-4">
                                                <dt>No. HP Wali</dt>
                                                <dd>{{ $registration->no_hp_wali ?? '-' }}</dd>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             @endif
                        </div>
                    </div>

                    <!-- Tab Berkas -->
                    <div class="tab-pane" id="berkas">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-alt fa-4x text-primary mb-3"></i>
                                        <h5>Kartu Keluarga</h5>
                                        @if($registration->file_kk)
                                            <a href="{{ asset('storage/' . $registration->file_kk) }}" target="_blank" class="btn btn-primary btn-sm btn-block mt-3"><i class="fas fa-eye"></i> Lihat File</a>
                                            <a href="{{ asset('storage/' . $registration->file_kk) }}" download class="btn btn-default btn-sm btn-block mt-1"><i class="fas fa-download"></i> Download</a>
                                        @else
                                            <span class="badge badge-secondary mt-2">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-alt fa-4x text-info mb-3"></i>
                                        <h5>Akta Kelahiran</h5>
                                        @if($registration->file_akta)
                                            <a href="{{ asset('storage/' . $registration->file_akta) }}" target="_blank" class="btn btn-info btn-sm btn-block mt-3"><i class="fas fa-eye"></i> Lihat File</a>
                                            <a href="{{ asset('storage/' . $registration->file_akta) }}" download class="btn btn-default btn-sm btn-block mt-1"><i class="fas fa-download"></i> Download</a>
                                        @else
                                            <span class="badge badge-secondary mt-2">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body text-center">
                                        <i class="fas fa-book fa-4x text-warning mb-3"></i>
                                        <h5>Raport Terakhir</h5>
                                        @if($registration->file_raport)
                                            <a href="{{ asset('storage/' . $registration->file_raport) }}" target="_blank" class="btn btn-warning btn-sm btn-block mt-3 text-white"><i class="fas fa-eye"></i> Lihat File</a>
                                            <a href="{{ asset('storage/' . $registration->file_raport) }}" download class="btn btn-default btn-sm btn-block mt-1"><i class="fas fa-download"></i> Download</a>
                                        @else
                                            <span class="badge badge-secondary mt-2">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmStatus(status) {
        let title = status === 'diterima' ? 'Terima Siswa?' : 'Tolak Siswa?';
        let text = status === 'diterima' ? 'Berikan catatan untuk siswa (opsional)' : 'Wajib berikan alasan penolakan!';
        let icon = status === 'diterima' ? 'success' : 'warning';
        let placeholder = status === 'diterima' ? 'Selamat! Anda diterima...' : 'Maaf, nilai anda kurang...';

        Swal.fire({
            title: title,
            input: 'textarea',
            inputLabel: text,
            inputPlaceholder: placeholder,
            inputAttributes: {
                'aria-label': 'Tulis catatan disini'
            },
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            preConfirm: (note) => {
                if (status === 'ditolak' && !note) {
                    Swal.showValidationMessage('Alasan penolakan wajib diisi!')
                }
                return note;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('inputStatus').value = status;
                document.getElementById('inputCatatan').value = result.value;
                document.getElementById('statusForm').submit();
            }
        });
    }
</script>
@endpush
@endsection
