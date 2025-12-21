<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::latest()->paginate(10);
        return view('admin.advertisements.index', compact('advertisements'));
    }

    public function create()
    {
        return view('admin.advertisements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,script,code',
            'position' => 'required|string',
            'image' => 'required_if:type,image|image|max:2048',
            'value_script' => 'required_if:type,script,code',
            'url' => 'nullable|url',
        ]);

        $data = $request->except(['image', 'value_script']);

        if ($request->type === 'image' && $request->hasFile('image')) {
            $data['value'] = $request->file('image')->store('advertisements', 'public');
        } else {
            $data['value'] = $request->value_script;
        }

        $data['is_active'] = $request->has('is_active');

        Advertisement::create($data);

        return redirect()->route('admin.advertisements.index')->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function edit(Advertisement $advertisement)
    {
        return view('admin.advertisements.edit', compact('advertisement'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,script,code',
            'position' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'url' => 'nullable|url',
        ]);

        $data = $request->except(['image', 'value_script']);

        if ($request->type === 'image') {
            if ($request->hasFile('image')) {
                if ($advertisement->type === 'image' && $advertisement->value) {
                    Storage::disk('public')->delete($advertisement->value);
                }
                $data['value'] = $request->file('image')->store('advertisements', 'public');
            } else {
                $data['value'] = $advertisement->value; // Keep old image
            }
        } else {
             $data['value'] = $request->value_script;
        }

        $data['is_active'] = $request->has('is_active');

        $advertisement->update($data);

        return redirect()->route('admin.advertisements.index')->with('success', 'Iklan berhasil diperbarui.');
    }

    public function destroy(Advertisement $advertisement)
    {
        if ($advertisement->type === 'image' && $advertisement->value) {
            Storage::disk('public')->delete($advertisement->value);
        }
        $advertisement->delete();
        return redirect()->route('admin.advertisements.index')->with('success', 'Iklan berhasil dihapus.');
    }
}
