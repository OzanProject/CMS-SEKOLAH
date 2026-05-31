<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CommitteeTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\CommitteeImport;
use App\Models\Committee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CommitteeController extends Controller
{
    public function index(Request $request)
    {
        $query = Committee::query();

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('position', 'like', '%'.$request->search.'%');
        }

        $committees = $query->paginate(10);

        return view('admin.committees.index', compact('committees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'position' => 'nullable',
        ]);

        Committee::create($request->all());

        return back()->with('success', 'Data panitia berhasil ditambahkan.');
    }

    public function update(Request $request, Committee $committee)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'position' => 'nullable',
        ]);

        $committee->update($request->all());

        return back()->with('success', 'Data panitia berhasil diperbarui.');
    }

    public function destroy(Committee $committee)
    {
        $committee->delete();

        return back()->with('success', 'Data panitia berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new CommitteeImport, $request->file('file'));

        return back()->with('success', 'Data panitia berhasil diimport.');
    }

    public function downloadTemplate()
    {
        return Excel::download(new CommitteeTemplateExport, 'Template_Import_Panitia.xlsx');
    }
}
