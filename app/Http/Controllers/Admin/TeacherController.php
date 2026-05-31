<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TeacherTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\TeacherImport;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('nip', 'like', '%'.$request->search.'%');
        }

        $teachers = $query->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'nip' => 'nullable|unique:teachers,nip',
        ]);

        Teacher::create($request->all());

        return back()->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'nip' => 'nullable|unique:teachers,nip,'.$teacher->id,
        ]);

        $teacher->update($request->all());

        return back()->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return back()->with('success', 'Data guru berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new TeacherImport, $request->file('file'));

        return back()->with('success', 'Data guru berhasil diimport.');
    }

    public function downloadTemplate()
    {
        return Excel::download(new TeacherTemplateExport, 'Template_Import_Guru.xlsx');
    }
}
