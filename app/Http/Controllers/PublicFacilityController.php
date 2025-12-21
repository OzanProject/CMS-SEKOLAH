<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class PublicFacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::latest()->get();
        return view('facilities.index', compact('facilities'));
    }

    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }
}
