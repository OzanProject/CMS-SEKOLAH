<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }

        $articles = $query->orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();

        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-'.uniqid();
        }
        $data['slug'] = $slug;
        $data['author_id'] = auth()->id();

        // Sync string category for backward compatibility
        $category = \App\Models\Category::find($request->category_id);
        $data['category'] = $category->name;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['is_featured'] = $request->has('is_featured');

        if (empty($data['published_at']) && ($data['status'] ?? 'published') === 'published') {
            $data['published_at'] = now();
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = \App\Models\Category::all();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->title != $article->title) {
            $slug = Str::slug($request->title);
            if (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug .= '-'.uniqid();
            }
            $data['slug'] = $slug;
        } else {
            unset($data['slug']);
        }

        // Sync string category
        $category = \App\Models\Category::find($request->category_id);
        $data['category'] = $category->name;

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['is_featured'] = $request->has('is_featured');

        if (empty($data['published_at']) && ($data['status'] ?? $article->status) === 'published') {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:articles,id',
        ]);

        $articles = Article::whereIn('id', $request->ids)->get();

        foreach ($articles as $article) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $article->delete();
        }

        return redirect()->route('admin.articles.index')->with('success', count($articles).' Artikel berhasil dihapus.');
    }
}
