<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function disclaimer()
    {
        return view('pages.disclaimer');
    }

    public function contact()
    {
        // If we want a dedicated contact page separate from home
        return view('pages.contact');
    }
}
