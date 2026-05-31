<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function index()
    {
        // Only fetch profile-related settings
        $settings = Setting::whereIn('key', [
            'school_description',
            'school_vision',
            'school_mission',
            'school_profile_image',
        ])->pluck('value', 'key');

        return view('admin.school_profile.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'school_profile_image']);

        // Update Text Fields
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Handle Profile Image Upload
        if ($request->hasFile('school_profile_image')) {
            $file = $request->file('school_profile_image');
            $path = $file->store('settings', 'public');

            // Delete old image if exists
            $oldImage = Setting::getValue('school_profile_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            Setting::updateOrCreate(
                ['key' => 'school_profile_image'],
                ['value' => $path, 'type' => 'image']
            );
        }

        return redirect()->route('admin.school_profile.index')->with('success', 'Profil Sekolah berhasil diperbarui.');
    }
}
