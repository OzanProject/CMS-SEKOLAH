<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pendaftaran',
        'nama_lengkap',
        'nisn',
        'nik', 'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_sekolah',
        'alamat',
        'rt', 'rw', 'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos',
        
        // Ortu
        'nama_ayah', 'nik_ayah', 'tahun_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
        'nama_ibu', 'nik_ibu', 'tahun_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
        'nama_wali', 'nik_wali', 'no_hp_wali',
        
        'no_hp',
        'file_kk',
        'file_akta',
        'file_raport',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
