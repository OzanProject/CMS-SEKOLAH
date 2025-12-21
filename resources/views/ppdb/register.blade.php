@extends('layouts.public')

@section('title', 'Formulir Pendaftaran Lengkap')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-800 to-indigo-900 pb-32 pt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4">
            Formulir Pendaftaran Siswa Baru
        </h1>
        <p class="text-lg text-blue-200 max-w-3xl mx-auto mb-8">
            Mohon isi data di bawah ini dengan lengkap dan benar sesuai dengan dokumen kependudukan (KK/Akta) yang berlaku.
        </p>
        <div>
            <a href="{{ route('ppdb.check-status') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 transition duration-150 ease-in-out shadow-sm">
                <i class="fas fa-search mr-2"></i> Sudah Mendaftar? Cek Status Disini
            </a>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-20 relative z-10">
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
        
        <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 mb-0 rounded-r">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Mohon perbaiki kesalahan berikut:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- B. DATA PRIBADI SISWA -->
            <div class="p-8 border-b border-gray-100">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xl mr-4 shadow-sm">1</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Data Pribadi Calon Siswa</h2>
                        <p class="text-sm text-gray-500">Identitas diri sesuai Akta Kelahiran/Ijazah</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Muhammad Rizky Pratama" required>
                    </div>

                    <!-- NISN & NIK -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">NISN (10 Digit)</label>
                        <input type="text" inputmode="numeric" pattern="\d{10}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="nisn" value="{{ old('nisn') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="0012345678" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">NIK (16 Digit)</label>
                        <input type="text" inputmode="numeric" pattern="\d{16}" maxlength="16" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="nik" value="{{ old('nik') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="3201xxxxxxxxxxxx" required>
                    </div>

                    <!-- TTL -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- JK & Agama -->
                     <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                             <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                     <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Agama</label>
                        <select name="agama" class="form-select w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih --</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>

                    <!-- Asal Sekolah -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Asal Sekolah (SD/MI)</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Nama SD Asal" required>
                    </div>
                </div>
            </div>

            <!-- C. DETAIL ALAMAT -->
            <div class="p-8 border-b border-gray-100 bg-gray-50/30">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xl mr-4 shadow-sm">2</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Alamat Tempat Tinggal</h2>
                        <p class="text-sm text-gray-500">Sesuai Kartu Keluarga (KK)</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                    <div class="md:col-span-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Jalan / Dusun</label>
                        <textarea name="alamat" rows="2" class="form-textarea w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Jl. Mawar No. 123 / Dusun Sukamaju" required>{{ old('alamat') }}</textarea>
                    </div>
                    
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">RT</label>
                        <input type="number" name="rt" value="{{ old('rt') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="001" required>
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">RW</label>
                        <input type="number" name="rw" value="{{ old('rw') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="002" required>
                    </div>

                    <!-- Wilayah Indonesia -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
                        <select id="provinsi" class="form-select w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                        <input type="hidden" name="provinsi" id="input_provinsi" value="{{ old('provinsi') }}">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten / Kota</label>
                         <select id="kabupaten" class="form-select w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" disabled required>
                            <option value="">Pilih Kabupaten</option>
                        </select>
                        <input type="hidden" name="kabupaten" id="input_kabupaten" value="{{ old('kabupaten') }}">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
                         <select id="kecamatan" class="form-select w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" disabled required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                         <input type="hidden" name="kecamatan" id="input_kecamatan" value="{{ old('kecamatan') }}">
                    </div>
                    <div class="md:col-span-2">
                         <label class="block text-sm font-semibold text-gray-700 mb-1">Desa / Kelurahan</label>
                         <select id="desa" class="form-select w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" disabled required>
                            <option value="">Pilih Desa</option>
                        </select>
                        <input type="hidden" name="desa" id="input_desa" value="{{ old('desa') }}">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Pos</label>
                        <input type="number" name="kode_pos" value="{{ old('kode_pos') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                </div>
            </div>

            <!-- D. DATA ORANG TUA / WALI -->
            <div class="p-8 border-b border-gray-100">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-xl mr-4 shadow-sm">3</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Data Orang Tua / Wali</h2>
                        <p class="text-sm text-gray-500">Informasi Ayah, Ibu, dan Wali murid</p>
                    </div>
                </div>

                <!-- AYAH -->
                <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center"><i class="fas fa-male mr-2"></i> Data Ayah Kandung</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                             <label class="block text-xs font-bold text-gray-500 uppercase">Nama Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">NIK Ayah</label>
                            <input type="text" inputmode="numeric" pattern="\d{16}" maxlength="16" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="nik_ayah" value="{{ old('nik_ayah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Tahun Lahir</label>
                            <input type="number" name="tahun_lahir_ayah" value="{{ old('tahun_lahir_ayah') }}" placeholder="YYYY" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Pendidikan</label>
                            <select name="pendidikan_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA/SMK</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Pekerjaan</label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Penghasilan Bulanan</label>
                            <select name="penghasilan_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                                <option value="< 500.000">< Rp 500.000</option>
                                <option value="500.000 - 1.000.000">Rp 500.000 - 1 Juta</option>
                                <option value="1.000.000 - 2.000.000">Rp 1 Juta - 2 Juta</option>
                                <option value="2.000.000 - 5.000.000">Rp 2 Juta - 5 Juta</option>
                                <option value="> 5.000.000">> Rp 5 Juta</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- IBU -->
                <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center"><i class="fas fa-female mr-2"></i> Data Ibu Kandung</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                             <label class="block text-xs font-bold text-gray-500 uppercase">Nama Ibu</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">NIK Ibu</label>
                            <input type="text" inputmode="numeric" pattern="\d{16}" maxlength="16" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="nik_ibu" value="{{ old('nik_ibu') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Tahun Lahir</label>
                            <input type="number" name="tahun_lahir_ibu" value="{{ old('tahun_lahir_ibu') }}" placeholder="YYYY" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Pendidikan</label>
                            <select name="pendidikan_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA/SMK</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Pekerjaan</label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase">Penghasilan Bulanan</label>
                            <select name="penghasilan_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                                <option value="< 500.000">< Rp 500.000</option>
                                <option value="500.000 - 1.000.000">Rp 500.000 - 1 Juta</option>
                                <option value="1.000.000 - 2.000.000">Rp 1 Juta - 2 Juta</option>
                                <option value="2.000.000 - 5.000.000">Rp 2 Juta - 5 Juta</option>
                                <option value="> 5.000.000">> Rp 5 Juta</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                     <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor HP / WhatsApp Aktif</label>
                        <input type="text" inputmode="numeric" maxlength="15" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="no_hp" value="{{ old('no_hp') }}" class="form-input w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="08xxxxxxxxxx" required>
                    </div>
                </div>

                <!-- Wali (Optional) -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <p class="text-sm font-bold text-gray-500 mb-4">Data Wali (Diisi jika tidak tinggal bersama Orang Tua)</p>
                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="nama_wali" value="{{ old('nama_wali') }}" class="form-input rounded-lg border-gray-300" placeholder="Nama Wali">
                        <input type="number" name="nik_wali" value="{{ old('nik_wali') }}" class="form-input rounded-lg border-gray-300" placeholder="NIK Wali">
                        <input type="number" name="no_hp_wali" value="{{ old('no_hp_wali') }}" class="form-input rounded-lg border-gray-300" placeholder="No HP Wali">
                    </div>
                </div>
            </div>

            <!-- E. UPLOAD BERKAS -->
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-xl mr-4 shadow-sm">4</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Upload Data Pendukung</h2>
                        <p class="text-sm text-gray-500">Berkas digital (Scan PDF/Foto Jelas)</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- KK -->
                    <div class="text-center group cursor-pointer">
                        <label class="block p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition duration-300">
                            <i class="fas fa-file-alt text-4xl text-gray-300 group-hover:text-purple-500 mb-3 transition"></i>
                            <span class="block text-gray-900 font-medium mb-1">Kartu Keluarga</span>
                            <span class="block text-gray-500 text-xs mb-4">Max 2MB (PDF/JPG)</span>
                            <input type="file" name="file_kk" class="hidden">
                             <div class="bg-purple-600 text-white py-2 px-4 rounded-lg text-sm inline-block shadow-md">Pilih File</div>
                        </label>
                    </div>

                    <!-- Akta -->
                    <div class="text-center group cursor-pointer">
                        <label class="block p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition duration-300">
                            <i class="fas fa-baby text-4xl text-gray-300 group-hover:text-purple-500 mb-3 transition"></i>
                            <span class="block text-gray-900 font-medium mb-1">Akta Kelahiran</span>
                            <span class="block text-gray-500 text-xs mb-4">Max 2MB (PDF/JPG)</span>
                            <input type="file" name="file_akta" class="hidden">
                             <div class="bg-purple-600 text-white py-2 px-4 rounded-lg text-sm inline-block shadow-md">Pilih File</div>
                        </label>
                    </div>

                    <!-- Raport -->
                    <div class="text-center group cursor-pointer">
                         <label class="block p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition duration-300">
                            <i class="fas fa-book text-4xl text-gray-300 group-hover:text-purple-500 mb-3 transition"></i>
                            <span class="block text-gray-900 font-medium mb-1">Raport Terakhir</span>
                            <span class="block text-gray-500 text-xs mb-4">Max 2MB (PDF/JPG)</span>
                            <input type="file" name="file_raport" class="hidden">
                            <div class="bg-purple-600 text-white py-2 px-4 rounded-lg text-sm inline-block shadow-md">Pilih File</div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="bg-gray-50 p-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-gray-500 text-sm">
                    <p><i class="fas fa-info-circle mr-1"></i> Data yang dikirim akan diverifikasi oleh Panitia PPDB.</p>
                </div>
                <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-blue-700 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 text-white font-bold py-4 px-10 rounded-xl shadow-lg transform transition hover:-translate-y-1 text-lg">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Formulir Pendaftaran
                </button>
            </div>

        </form>
    </div>
</div>

{{-- Script untuk menampilkan nama file yang dipilih --}}
<script>
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if(fileName) {
                const label = e.target.closest('label').querySelector('.bg-purple-600');
                if(label) {
                    label.textContent = fileName;
                    label.classList.remove('bg-purple-600');
                    label.classList.add('bg-green-600');
                }
            }
        });
    });

    // API Wilayah Indonesia
    const baseUrl = "https://www.emsifa.com/api-wilayah-indonesia/api";
    
    const selectProvinsi = document.getElementById('provinsi');
    const selectKabupaten = document.getElementById('kabupaten');
    const selectKecamatan = document.getElementById('kecamatan');
    const selectDesa = document.getElementById('desa');

    const inputProvinsi = document.getElementById('input_provinsi');
    const inputKabupaten = document.getElementById('input_kabupaten');
    const inputKecamatan = document.getElementById('input_kecamatan');
    const inputDesa = document.getElementById('input_desa');

    // Fetch Provinsi
    fetch(`${baseUrl}/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            let data = provinces;
            data.forEach(prov => {
                const option = document.createElement('option');
                option.value = prov.id;
                option.text = prov.name;
                option.setAttribute('data-name', prov.name);
                selectProvinsi.add(option);
            });
        });

    // Handle Provinsi Change
    selectProvinsi.addEventListener('change', function() {
        if(this.value) {
            const selectedName = this.options[this.selectedIndex].getAttribute('data-name');
            inputProvinsi.value = selectedName; // Store Name

            selectKabupaten.disabled = false;
            selectKabupaten.innerHTML = '<option value="">Memuat...</option>';
            
            fetch(`${baseUrl}/regencies/${this.value}.json`)
                .then(response => response.json())
                .then(regencies => {
                    selectKabupaten.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    regencies.forEach(reg => {
                        const option = document.createElement('option');
                        option.value = reg.id;
                        option.text = reg.name;
                        option.setAttribute('data-name', reg.name);
                        selectKabupaten.add(option);
                    });
                });
        } else {
            selectKabupaten.disabled = true;
            selectKecamatan.disabled = true;
            selectDesa.disabled = true;
        }
    });

    // Handle Kabupaten Change
    selectKabupaten.addEventListener('change', function() {
        if(this.value) {
            const selectedName = this.options[this.selectedIndex].getAttribute('data-name');
            inputKabupaten.value = selectedName;

            selectKecamatan.disabled = false;
            selectKecamatan.innerHTML = '<option value="">Memuat...</option>';

            fetch(`${baseUrl}/districts/${this.value}.json`)
                .then(response => response.json())
                .then(districts => {
                    selectKecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    districts.forEach(dist => {
                        const option = document.createElement('option');
                        option.value = dist.id;
                        option.text = dist.name;
                        option.setAttribute('data-name', dist.name);
                        selectKecamatan.add(option);
                    });
                });
        }
    });

    // Handle Kecamatan Change
    selectKecamatan.addEventListener('change', function() {
        if(this.value) {
            const selectedName = this.options[this.selectedIndex].getAttribute('data-name');
            inputKecamatan.value = selectedName;

            selectDesa.disabled = false;
            selectDesa.innerHTML = '<option value="">Memuat...</option>';

            fetch(`${baseUrl}/villages/${this.value}.json`)
                .then(response => response.json())
                .then(villages => {
                    selectDesa.innerHTML = '<option value="">Pilih Desa</option>';
                    villages.forEach(village => {
                        const option = document.createElement('option');
                        option.value = village.id;
                        option.text = village.name;
                        option.setAttribute('data-name', village.name);
                        selectDesa.add(option);
                    });
                });
        }
    });

     // Handle Desa Change
    selectDesa.addEventListener('change', function() {
       if(this.value) {
            const selectedName = this.options[this.selectedIndex].getAttribute('data-name');
            inputDesa.value = selectedName;
       }
    });

</script>
@endsection
