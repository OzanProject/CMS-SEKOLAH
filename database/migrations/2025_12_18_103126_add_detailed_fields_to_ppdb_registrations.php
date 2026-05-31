<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            // Data Pribadi Siswa
            $table->string('nik', 16)->after('nama_lengkap')->nullable();
            $table->string('agama')->after('jenis_kelamin')->nullable();

            // Detail Alamat
            $table->string('rt', 5)->after('alamat')->nullable();
            $table->string('rw', 5)->after('rt')->nullable();
            $table->string('desa')->after('rw')->nullable();
            $table->string('kecamatan')->after('desa')->nullable();
            $table->string('kabupaten')->after('kecamatan')->nullable();
            $table->string('kode_pos', 10)->after('kabupaten')->nullable();

            // Data Ayah
            $table->string('nik_ayah', 16)->after('nama_ayah')->nullable();
            $table->year('tahun_lahir_ayah')->after('nik_ayah')->nullable();
            $table->string('pendidikan_ayah')->after('tahun_lahir_ayah')->nullable();
            $table->string('penghasilan_ayah')->after('pekerjaan_ayah')->nullable();

            // Data Ibu
            $table->string('nik_ibu', 16)->after('nama_ibu')->nullable();
            $table->year('tahun_lahir_ibu')->after('nik_ibu')->nullable();
            $table->string('pendidikan_ibu')->after('tahun_lahir_ibu')->nullable();
            $table->string('penghasilan_ibu')->after('pekerjaan_ibu')->nullable();

            // Data Wali (Opsional)
            $table->string('nama_wali')->after('no_hp')->nullable();
            $table->string('nik_wali', 16)->after('nama_wali')->nullable();
            $table->string('no_hp_wali')->after('nik_wali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 'agama',
                'rt', 'rw', 'desa', 'kecamatan', 'kabupaten', 'kode_pos',
                'nik_ayah', 'tahun_lahir_ayah', 'pendidikan_ayah', 'penghasilan_ayah',
                'nik_ibu', 'tahun_lahir_ibu', 'pendidikan_ibu', 'penghasilan_ibu',
                'nama_wali', 'nik_wali', 'no_hp_wali',
            ]);
        });
    }
};
