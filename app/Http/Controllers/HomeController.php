<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\VotingEvent;
use App\Models\Program;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        // 1. Banner Area (1 Feature + 4 Sub) - 5 Latest Articles
        $bannerArticles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
            
        $bannerFeature = $bannerArticles->first(); 
        $bannerSub = $bannerArticles->skip(1);

        // 2. Trending News (Top Views) - Take 2
        $trending = Article::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(2)
            ->get();

        // 3. Latest News List - Take 5
        $latestList = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // 4. What's New (Next latest after list) - Take 2
        $whatsNew = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->skip(5)
            ->take(2)
            ->get();

        // 5. Sky/Grid News (Middle Grid) - Take 4
        $gridNews = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->skip(7)
            ->take(4)
            ->get();
            
        // 6. Bottom Grid (Extra Content) - Take 8
        $bottomGrid = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->skip(11)
            ->take(8)
            ->get();

        // Fetch active voting event if any
        $activeVotingEvent = VotingEvent::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        $programs = Program::all();
        $facilities = Facility::all();
        $galleries = Gallery::latest()->take(8)->get();
        $sliders = Slider::where('is_active', true)->latest()->get();

        return view('welcome', compact(
            'bannerFeature', 
            'bannerSub', 
            'trending', 
            'latestList', 
            'whatsNew', 
            'gridNews', 
            'bottomGrid',
            'activeVotingEvent', 
            'programs', 
            'facilities', 
            'galleries', 
            'sliders'
        ));
    }
}
