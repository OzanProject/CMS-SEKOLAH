<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\PpdbRegistration;
use App\Models\VotingEvent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Committee;
use App\Models\Classroom;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_registrants' => PpdbRegistration::count(),
            'registrants_accepted' => PpdbRegistration::where('status', 'diterima')->count(),
            'total_articles' => Article::count(),
            'active_voting' => VotingEvent::where('is_active', true)->count(),
            // Master Data Stats
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'total_committees' => Committee::count(),
            'total_classrooms' => Classroom::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
