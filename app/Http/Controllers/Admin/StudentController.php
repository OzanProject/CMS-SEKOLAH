<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Classroom;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('classroom');

        if ($request->classroom_id) {
            $query->where('classroom_id', $request->classroom_id);
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', 'like', '%' . $request->search . '%');
        }

        $students = $query->paginate(10);
        $classrooms = Classroom::all();

        return view('admin.students.index', compact('students', 'classrooms'));
    }

    public function import(Request $request) 
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new StudentImport($request->classroom_id), $request->file('file'));
        
        return back()->with('success', 'Data siswa berhasil diimport.');
    }

    public function downloadTemplate(Request $request)
    {
        $filename = 'Template_Import_Siswa.xlsx';
        
        if ($request->classroom_id) {
            $classroom = Classroom::find($request->classroom_id);
            if ($classroom) {
                $filename = 'Template_Siswa_Kelas_' . $classroom->name . '.xlsx';
            }
        }

        return Excel::download(new \App\Exports\StudentTemplateExport, $filename);
    }
    
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Siswa berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:students,id',
        ]);

        $students = Student::whereIn('id', $request->ids)->get();
        $count = $students->count();

        Student::whereIn('id', $request->ids)->delete();

        return back()->with('success', $count . ' Siswa berhasil dihapus.');
    }
}
