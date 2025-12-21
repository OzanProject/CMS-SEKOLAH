<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class PublicProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->get();
        return view('programs.index', compact('programs'));
    }

    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }
}
