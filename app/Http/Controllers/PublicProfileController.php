<?php

namespace App\Http\Controllers;

class PublicProfileController extends Controller
{
    public function index()
    {
        // Settings are already shared globally via AppServiceProvider, but we can fetch specific ones if needed validation
        // or just rely on the view usage.
        return view('profile.index');
    }
}
