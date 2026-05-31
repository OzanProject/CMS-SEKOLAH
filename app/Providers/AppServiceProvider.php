<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $school_settings = \App\Models\Setting::all()->pluck('value', 'key');
                \Illuminate\Support\Facades\View::share('school_settings', $school_settings);
            } else {
                \Illuminate\Support\Facades\View::share('school_settings', []);
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('links')) {
                $links = \App\Models\Link::all();
                \Illuminate\Support\Facades\View::share('footer_links', $links);
            } else {
                \Illuminate\Support\Facades\View::share('footer_links', []);
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('articles')) {
                $footerPopulerArticles = \App\Models\Article::where('status', 'published')
                    ->orderBy('views', 'desc')
                    ->orderBy('published_at', 'desc')
                    ->take(5)
                    ->get();
                \Illuminate\Support\Facades\View::share('footerPopulerArticles', $footerPopulerArticles);
            } else {
                \Illuminate\Support\Facades\View::share('footerPopulerArticles', collect([]));
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('advertisements')) {
                $globalAds = \App\Models\Advertisement::where('is_active', true)->get()->groupBy('position');
                \Illuminate\Support\Facades\View::share('globalAds', $globalAds);
            } else {
                \Illuminate\Support\Facades\View::share('globalAds', collect([]));
            }
        } catch (\Exception $e) {
            // Database connection failed or other error
            // Share empty arrays to prevent views from crashing
            \Illuminate\Support\Facades\View::share('school_settings', []);
            \Illuminate\Support\Facades\View::share('footer_links', []);
            \Illuminate\Support\Facades\View::share('footerPopulerArticles', collect([]));
            \Illuminate\Support\Facades\View::share('globalAds', collect([]));
        }
    }
}
