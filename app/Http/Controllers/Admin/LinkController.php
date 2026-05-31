<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::latest()->paginate(10);

        return view('admin.links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|starts_with:http://,https://,/',
            'target' => 'required|in:_blank,_self',
        ]);

        Link::create($validated);

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil ditambahkan');
    }

    public function edit(Link $link)
    {
        return view('admin.links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|starts_with:http://,https://,/', // Allow relative paths like /voting/login
            'target' => 'required|in:_blank,_self',
        ]);

        $link->update($validated);

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil diperbarui');
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil dihapus');
    }
}
