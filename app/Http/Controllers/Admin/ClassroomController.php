<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $query = Classroom::withCount('students');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $perPage = $request->input('per_page', 10);
        $classrooms = $query->latest()->paginate($perPage)->withQueryString();

        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:classrooms,name']);
        Classroom::create($request->all());

        return back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate(['name' => 'required|unique:classrooms,name,'.$classroom->id]);
        $classroom->update($request->all());

        return back()->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return back()->with('success', 'Kelas berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:classrooms,id',
        ]);

        Classroom::whereIn('id', $request->ids)->delete();

        return back()->with('success', count($request->ids) . ' Kelas berhasil dihapus.');
    }
}
