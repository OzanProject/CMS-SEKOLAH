<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Facility;
use App\Models\Program;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 'published')->latest()->get();
        $programs = Program::latest()->get();
        $facilities = Facility::latest()->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>';
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static Pages
        $content .= '<url>';
        $content .= '<loc>'.url('/').'</loc>';
        $content .= '<lastmod>'.now()->toIso8601String().'</lastmod>';
        $content .= '<changefreq>daily</changefreq>';
        $content .= '<priority>1.0</priority>';
        $content .= '</url>';

        $content .= '<url>';
        $content .= '<loc>'.url('/ppdb').'</loc>';
        $content .= '<changefreq>monthly</changefreq>';
        $content .= '<priority>0.8</priority>';
        $content .= '</url>';

        $content .= '<url>';
        $content .= '<loc>'.url('/voting/login').'</loc>';
        $content .= '<changefreq>monthly</changefreq>';
        $content .= '<priority>0.6</priority>';
        $content .= '</url>';

        // Articles
        foreach ($articles as $article) {
            $content .= '<url>';
            $content .= '<loc>'.route('articles.show', $article->slug).'</loc>';
            $content .= '<lastmod>'.$article->updated_at->toIso8601String().'</lastmod>';
            $content .= '<changefreq>weekly</changefreq>';
            $content .= '<priority>0.8</priority>';
            $content .= '</url>';
        }

        // Programs
        foreach ($programs as $program) {
            $content .= '<url>';
            $content .= '<loc>'.route('programs.show', $program).'</loc>';
            $content .= '<lastmod>'.$program->updated_at->toIso8601String().'</lastmod>';
            $content .= '<changefreq>monthly</changefreq>';
            $content .= '<priority>0.7</priority>';
            $content .= '</url>';
        }

        // Facilities
        foreach ($facilities as $facility) {
            $content .= '<url>';
            $content .= '<loc>'.route('facilities.show', $facility).'</loc>';
            $content .= '<lastmod>'.$facility->updated_at->toIso8601String().'</lastmod>';
            $content .= '<changefreq>monthly</changefreq>';
            $content .= '<priority>0.7</priority>';
            $content .= '</url>';
        }

        $content .= '</urlset>';

        return Response::make($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
