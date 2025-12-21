<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class PublicProfileController extends Controller
{
    public function index()
    {
        // Settings are already shared globally via AppServiceProvider, but we can fetch specific ones if needed validation
        // or just rely on the view usage.
        return view('profile.index');
    }
}
