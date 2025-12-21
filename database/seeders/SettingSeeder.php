<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'school_name', 'value' => 'SMPN 4 KONOHA', 'type' => 'text'],
            ['key' => 'school_description', 'value' => 'Sekolah Menengah Pertama Negeri 4 Konoha adalah sekolah unggulan yang berfokus pada pengembangan karakter dan teknologi.', 'type' => 'textarea'],
            ['key' => 'school_address', 'value' => 'Jalan Raya Konoha No. 4, Desa Konoha', 'type' => 'text'],
            ['key' => 'school_phone', 'value' => '(021) 12345678', 'type' => 'text'],
            ['key' => 'school_email', 'value' => 'info@smpn4konoha.sch.id', 'type' => 'text'],
            ['key' => 'school_logo', 'value' => null, 'type' => 'image'], // Disimpan di storage/settings
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/smpn4konoha', 'type' => 'text'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/smpn4konoha', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
