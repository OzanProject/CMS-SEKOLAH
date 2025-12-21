@extends('layouts.public')

@section('title', 'Formulir Pendaftaran Siswa Baru')

@section('content')
<!-- Hero Header -->
<div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 pb-32 pt-20 overflow-hidden">
    <!-- Decorative Shapes -->
    <div class="absolute top-0 left-0 -ml-20 -mt-10 w-64 h-64 rounded-full bg-blue-500 opacity-20 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 -mr-20 -mb-20 w-80 h-80 rounded-full bg-indigo-500 opacity-20 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block py-1 px-3 rounded-full bg-blue-800 bg-opacity-50 border border-blue-400 text-blue-100 text-sm font-semibold mb-4 backdrop-blur-sm">
            Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white mb-6 leading-tight">
            Pendaftaran Peserta Didik Baru
        </h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-8 font-light leading-relaxed">
            Bergabunglah bersama kami untuk mencetak generasi unggul, berkarakter, dan berprestasi.
        </p>
        
        <div class="flex justify-center space-x-4">
             <a href="{{ route('ppdb.check-status') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-blue-900 bg-white hover:bg-gray-50 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <i class="fas fa-search mr-2"></i> Cek Status Pendaftaran
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 pb-20 relative z-20">
    <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-8">
        @csrf
        
        <!-- Left Column: Form Sections -->
        <div class="lg:w-2/3 space-y-8">
            
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm animate__animated animate__shakeX">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan pengisian:</h3>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- STEP 1: DATA PRIBADI -->
            <div id="step1" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition hover:shadow-2xl duration-300">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="bg-white text-blue-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3 shadow">1</span>
                        Data Pribadi Calon Siswa
                    </h2>
                    <i class="fas fa-user text-white opacity-50 text-2xl"></i>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 focus:bg-white transition" placeholder="Sesuai Akta Kelahiran/Ijazah" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NISN <span class="text-red-500">*</span></label>
                            <input type="text" inputmode="numeric" pattern="\d{10}" maxlength="10" name="nisn" value="{{ old('nisn') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 focus:bg-white transition" placeholder="10 Digit Angka" required>
                             <p class="text-xs text-gray-400 mt-1">Cek di raport SD/MI</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                            <input type="text" inputmode="numeric" pattern="\d{16}" maxlength="16" name="nik" value="{{ old('nik') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 focus:bg-white transition" placeholder="16 Digit Angka" required>
                            <p class="text-xs text-gray-400 mt-1">Sesuai Kartu Keluarga</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 focus:bg-white transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 focus:bg-white transition" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="jenis_kelamin" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 focus:bg-white transition appearance-none" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                         <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Agama <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="agama" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 focus:bg-white transition appearance-none" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                 <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                             <label class="block text-sm font-bold text-gray-700 mb-2">Asal Sekolah (SD/MI) <span class="text-red-500">*</span></label>
                             <div class="relative">
                                 <i class="fas fa-school absolute left-4 top-4 text-gray-400"></i>
                                 <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 pl-11 pr-4 bg-gray-50 focus:bg-white transition" placeholder="Nama SD/MI Asal" required>
                             </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 2: ALAMAT -->
            <div id="step2" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition hover:shadow-2xl duration-300">
                 <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="bg-white text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3 shadow">2</span>
                        Alamat Tempat Tinggal
                    </h2>
                     <i class="fas fa-map-marker-alt text-white opacity-50 text-2xl"></i>
                </div>
                <div class="p-8">
                     <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                        <div class="md:col-span-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="2" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" placeholder="Nama Jalan, Gg, No. Rumah" required>{{ old('alamat') }}</textarea>
                        </div>
                         <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">RT / RW <span class="text-red-500">*</span></label>
                            <div class="flex space-x-4">
                                <input type="number" name="rt" value="{{ old('rt') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" placeholder="RT" required>
                                <input type="number" name="rw" value="{{ old('rw') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" placeholder="RW" required>
                            </div>
                        </div>
                        <div class="md:col-span-3">
                             <label class="block text-sm font-bold text-gray-700 mb-2">Kode Pos <span class="text-red-500">*</span></label>
                            <input type="number" name="kode_pos" value="{{ old('kode_pos') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" required>
                        </div>

                         <!-- Wilayah API -->
                        <div class="md:col-span-3">
                             <label class="block text-sm font-bold text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                             <select id="provinsi" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" required>
                                <option value="">Pilih Provinsi</option>
                            </select>
                            <input type="hidden" name="provinsi" id="input_provinsi" value="{{ old('provinsi') }}">
                        </div>
                        <div class="md:col-span-3">
                             <label class="block text-sm font-bold text-gray-700 mb-2">Kabupaten/Kota <span class="text-red-500">*</span></label>
                             <select id="kabupaten" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" disabled required>
                                <option value="">Pilih Kabupaten</option>
                            </select>
                            <input type="hidden" name="kabupaten" id="input_kabupaten" value="{{ old('kabupaten') }}">
                        </div>
                        <div class="md:col-span-3">
                             <label class="block text-sm font-bold text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                             <select id="kecamatan" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" disabled required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <input type="hidden" name="kecamatan" id="input_kecamatan" value="{{ old('kecamatan') }}">
                        </div>
                        <div class="md:col-span-3">
                             <label class="block text-sm font-bold text-gray-700 mb-2">Desa/Kelurahan <span class="text-red-500">*</span></label>
                             <select id="desa" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 bg-gray-50 focus:bg-white transition" disabled required>
                                <option value="">Pilih Desa</option>
                            </select>
                            <input type="hidden" name="desa" id="input_desa" value="{{ old('desa') }}">
                        </div>
                     </div>
                </div>
            </div>

            <!-- STEP 3: ORANG TUA / WALI -->
            <div id="step3" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition hover:shadow-2xl duration-300">
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="bg-white text-green-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3 shadow">3</span>
                        Data Orang Tua / Wali
                    </h2>
                     <i class="fas fa-users text-white opacity-50 text-2xl"></i>
                </div>
                <div class="p-8">
                    <!-- Tabs for Parent selection could be added here, but keeping it simple stack for now -->
                    
                    <!-- AYAH -->
                    <div class="mb-8 border-b border-gray-200 pb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center text-blue-900 border-l-4 border-blue-600 pl-3">
                            <i class="fas fa-male w-6 text-center mr-2"></i> Data Ayah Kandung
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-xl">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Nama Ayah</label>
                                <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">NIK Ayah</label>
                                <input type="text" inputmode="numeric" maxlength="16" name="nik_ayah" value="{{ old('nik_ayah') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Tahun Lahir</label>
                                <input type="number" placeholder="YYYY" name="tahun_lahir_ayah" value="{{ old('tahun_lahir_ayah') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Penghasilan</label>
                                <select name="penghasilan_ayah" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                                    <option value="< 500.000">< Rp 500.000</option>
                                    <option value="500.000 - 1.000.000">Rp 500rb - 1 Juta</option>
                                    <option value="1.000.000 - 2.000.000">Rp 1 Juta - 2 Juta</option>
                                    <option value="2.000.000 - 5.000.000">Rp 2 Juta - 5 Juta</option>
                                    <option value="> 5.000.000">> Rp 5 Juta</option>
                                </select>
                            </div>
                        </div>
                    </div>

                     <!-- IBU -->
                    <div class="mb-8 border-b border-gray-200 pb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center text-pink-900 border-l-4 border-pink-500 pl-3">
                            <i class="fas fa-female w-6 text-center mr-2"></i> Data Ibu Kandung
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-xl">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Nama Ibu</label>
                                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">NIK Ibu</label>
                                <input type="text" inputmode="numeric" maxlength="16" name="nik_ibu" value="{{ old('nik_ibu') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Tahun Lahir</label>
                                <input type="number" placeholder="YYYY" name="tahun_lahir_ibu" value="{{ old('tahun_lahir_ibu') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Penghasilan</label>
                                <select name="penghasilan_ibu" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-2 px-3 focus:bg-white transition" required>
                                    <option value="< 500.000">< Rp 500.000</option>
                                    <option value="500.000 - 1.000.000">Rp 500rb - 1 Juta</option>
                                    <option value="1.000.000 - 2.000.000">Rp 1 Juta - 2 Juta</option>
                                    <option value="2.000.000 - 5.000.000">Rp 2 Juta - 5 Juta</option>
                                    <option value="> 5.000.000">> Rp 5 Juta</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fab fa-whatsapp absolute left-4 top-3.5 text-green-500 text-lg"></i>
                            <input type="text" inputmode="numeric" name="no_hp" value="{{ old('no_hp') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 pl-11 pr-4 bg-gray-50 focus:bg-white transition" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Nomor ini akan digunakan untuk informasi pengumuman.</p>
                    </div>

                </div>
            </div>

            <!-- STEP 4: UPLOAD BERKAS -->
            <div id="step4" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition hover:shadow-2xl duration-300">
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="bg-white text-purple-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3 shadow">4</span>
                        Upload Berkas
                    </h2>
                     <i class="fas fa-file-upload text-white opacity-50 text-2xl"></i>
                </div>
                <div class="p-8">
                     <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- KK -->
                        <div class="relative group">
                            <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-id-card text-3xl text-gray-400 group-hover:text-purple-600 mb-3 transition"></i>
                                    <p class="mb-1 text-sm font-bold text-gray-600 group-hover:text-purple-700">Kartu Keluarga (KK)</p>
                                    <p class="text-xs text-gray-400">PDF/JPG (Max 2MB)</p>
                                </div>
                                <input type="file" name="file_kk" class="hidden" />
                            </label>
                            <div class="text-center mt-2 text-xs font-medium text-green-600 file-name-display"></div>
                        </div>

                         <!-- Akta -->
                        <div class="relative group">
                            <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-child text-3xl text-gray-400 group-hover:text-purple-600 mb-3 transition"></i>
                                    <p class="mb-1 text-sm font-bold text-gray-600 group-hover:text-purple-700">Akta Kelahiran</p>
                                    <p class="text-xs text-gray-400">PDF/JPG (Max 2MB)</p>
                                </div>
                                <input type="file" name="file_akta" class="hidden" />
                            </label>
                             <div class="text-center mt-2 text-xs font-medium text-green-600 file-name-display"></div>
                        </div>

                         <!-- Raport -->
                         <div class="relative group">
                            <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-book-open text-3xl text-gray-400 group-hover:text-purple-600 mb-3 transition"></i>
                                    <p class="mb-1 text-sm font-bold text-gray-600 group-hover:text-purple-700">Ijazah / SKL</p>
                                    <p class="text-xs text-gray-400">PDF/JPG (Max 2MB)</p>
                                </div>
                                <input type="file" name="file_raport" class="hidden" />
                            </label>
                             <div class="text-center mt-2 text-xs font-medium text-green-600 file-name-display"></div>
                        </div>
                     </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold py-4 rounded-xl shadow-lg transform transition hover:scale-[1.01] flex items-center justify-center text-xl">
                <i class="fas fa-paper-plane mr-3"></i> Kirim Pendaftaran Sekarang
            </button>
            <p class="text-center text-gray-500 text-sm">
                Pastikan seluruh data sudah benar sebelum mengirim.
            </p>

        </div>

        <!-- Right Column: Navigation / Info Sticky -->
        <div class="hidden lg:block lg:w-1/3">
            <div class="sticky top-24 space-y-6">
                <!-- Data Summary Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 font-bold text-gray-800">
                        <i class="fas fa-list-ol mr-2 text-blue-600"></i> Tahapan Pengisian
                    </div>
                    <div class="p-6">
                        <ul class="space-y-4">
                            <li class="flex items-center text-blue-600 font-medium">
                                <i class="fas fa-check-circle mr-3"></i> Data Pribadi
                            </li>
                            <li class="flex items-center text-gray-500">
                                <i class="far fa-circle mr-3"></i> Alamat Domisili
                            </li>
                            <li class="flex items-center text-gray-500">
                                <i class="far fa-circle mr-3"></i> Data Orang Tua
                            </li>
                            <li class="flex items-center text-gray-500">
                                <i class="far fa-circle mr-3"></i> Upload Berkas
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-blue-600 rounded-2xl shadow-xl overflow-hidden text-white p-6 relative overflow-hidden">
                     <div class="absolute top-0 right-0 -mr-10 -mt-10 w-32 h-32 rounded-full bg-blue-500 opacity-20"></div>
                     <h3 class="font-bold text-lg mb-2 z-10 relative">Butuh Bantuan?</h3>
                     <p class="text-blue-100 text-sm mb-4 z-10 relative">Jika mengalami kendala saat mengisi formulir, silakan hubungi panitia.</p>
                     <a href="https://wa.me/{{ $school_settings['school_phone'] ?? '' }}" class="block text-center bg-white text-blue-600 py-2 rounded-lg font-bold hover:bg-blue-50 transition z-10 relative">
                         <i class="fab fa-whatsapp mr-1"></i> Hubungi Panitia
                     </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const display = e.target.closest('.group').querySelector('.file-name-display');
            if(fileName) {
                display.innerHTML = '<i class="fas fa-check mr-1"></i> ' + fileName;
                e.target.closest('label').classList.add('border-green-500', 'bg-green-50');
                e.target.closest('label').classList.remove('border-gray-300');
            }
        });
    });

    // API Wilayah Indonesia (Same logic as before, minimized for brevity in this artifact but fully implemented)
    const baseUrl = "https://www.emsifa.com/api-wilayah-indonesia/api";
    // ... [Reuse the exact same JS for Wilayah logic] ...
    const selectProvinsi = document.getElementById('provinsi');
    const selectKabupaten = document.getElementById('kabupaten');
    const selectKecamatan = document.getElementById('kecamatan');
    const selectDesa = document.getElementById('desa');

    const inputProvinsi = document.getElementById('input_provinsi');
    const inputKabupaten = document.getElementById('input_kabupaten');
    const inputKecamatan = document.getElementById('input_kecamatan');
    const inputDesa = document.getElementById('input_desa');

    fetch(`${baseUrl}/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            provinces.forEach(prov => {
                const option = document.createElement('option');
                option.value = prov.id;
                option.text = prov.name;
                option.setAttribute('data-name', prov.name);
                selectProvinsi.add(option);
            });
        });

    selectProvinsi.addEventListener('change', function() {
        if(this.value) {
            const selectedName = this.options[this.selectedIndex].getAttribute('data-name');
            inputProvinsi.value = selectedName;
            selectKabupaten.disabled = false;
            selectKabupaten.innerHTML = '<option value="">Memuat...</option>';
            
            fetch(`${baseUrl}/regencies/${this.value}.json`).then(r => r.json()).then(reg => {
                selectKabupaten.innerHTML = '<option value="">Pilih Kabupaten</option>';
                reg.forEach(r => {
                    let op = document.createElement('option');
                    op.value = r.id; op.text = r.name; op.setAttribute('data-name', r.name);
                    selectKabupaten.add(op);
                });
            });
        }
    });

    selectKabupaten.addEventListener('change', function() {
        if(this.value) {
            const selectedName = this.options[this.selectedIndex].getAttribute('data-name');
            inputKabupaten.value = selectedName;
            selectKecamatan.disabled = false;
            selectKecamatan.innerHTML = '<option value="">Memuat...</option>';
            
            fetch(`${baseUrl}/districts/${this.value}.json`).then(r => r.json()).then(dist => {
                selectKecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                dist.forEach(d => {
                    let op = document.createElement('option');
                    op.value = d.id; op.text = d.name; op.setAttribute('data-name', d.name);
                    selectKecamatan.add(op);
                });
            });
        }
    });

    selectKecamatan.addEventListener('change', function() {
        if(this.value) {
            const selectedName = this.options[this.selectedIndex].getAttribute('data-name');
            inputKecamatan.value = selectedName;
            selectDesa.disabled = false;
            selectDesa.innerHTML = '<option value="">Memuat...</option>';
            
            fetch(`${baseUrl}/villages/${this.value}.json`).then(r => r.json()).then(vill => {
                selectDesa.innerHTML = '<option value="">Pilih Desa</option>';
                vill.forEach(v => {
                    let op = document.createElement('option');
                    op.value = v.id; op.text = v.name; op.setAttribute('data-name', v.name);
                    selectDesa.add(op);
                });
            });
        }
    });

    selectDesa.addEventListener('change', function() {
        if(this.value) {
            inputDesa.value = this.options[this.selectedIndex].getAttribute('data-name');
        }
    });
</script>
@endsection
