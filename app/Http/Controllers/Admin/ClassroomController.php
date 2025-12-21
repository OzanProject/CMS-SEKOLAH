<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::withCount('students')->latest()->get();
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
        $request->validate(['name' => 'required|unique:classrooms,name,' . $classroom->id]);
        $classroom->update($request->all());
        return back()->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return back()->with('success', 'Kelas berhasil dihapus.');
    }
}
