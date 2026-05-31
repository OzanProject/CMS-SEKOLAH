<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\Slider;
use App\Models\VotingEvent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        // Fetch the 19 latest published articles to distribute across the home sections
        // Eager load 'author' and 'categoryRel' to prevent N+1 queries.
        $latestArticles = Article::with(['author', 'categoryRel'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(19)
            ->get();

        // 1. Banner Area (1 Feature + 4 Sub) - 5 Latest Articles
        $bannerFeature = $latestArticles->first();
        $bannerSub = $latestArticles->slice(1, 4);

        // 2. Trending News (Top Views) - Take 2
        $trending = Article::with(['author', 'categoryRel'])
            ->where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(2)
            ->get();

        // 3. Latest News List - Take 5
        $latestList = $latestArticles->slice(0, 5);

        // 4. What's New (Next latest after list) - Take 2
        $whatsNew = $latestArticles->slice(5, 2);

        // 5. Sky/Grid News (Middle Grid) - Take 4
        $gridNews = $latestArticles->slice(7, 4);

        // 6. Bottom Grid (Extra Content) - Take 8
        $bottomGrid = $latestArticles->slice(11, 8);

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
