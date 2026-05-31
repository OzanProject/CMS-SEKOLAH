<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class PublicGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('public.gallery.index', compact('galleries'));
    }
}
