<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published');

        // Search Filter
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }

        // Category Filter
        if ($request->has('category') && $request->category != '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $articles = $query->orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(9)->withQueryString();

        // Sidebar Data
        $categories = Category::withCount('articles')->get();
        $recentArticles = Article::where('status', 'published')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->take(5)->get();

        return view('articles.index', compact('articles', 'categories', 'recentArticles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment visit count
        $article->increment('views');

        // Related Articles (Same Category, exclude current)
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        // Recent Articles for Sidebar
        $recentArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(5)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles', 'recentArticles'));
    }
}
