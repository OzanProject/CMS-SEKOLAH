<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));

// PPDB Routes
Route::prefix('ppdb')->name('ppdb.')->group(base_path('routes/ppdb.php'));

// Voting Routes
Route::prefix('voting')->name('voting.')->group(base_path('routes/voting.php'));

// Clean URL Redirects
Route::redirect('/e-voting', '/voting/login');
Route::redirect('/ppdb', '/ppdb/register');

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Contact Message
Route::post('/messages', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

// Articles (Public)
Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Public Profile & Facilities
Route::get('/school-profile', [App\Http\Controllers\PublicProfileController::class, 'index'])->name('public_profile.index'); // Renamed to avoid clone with auth profile
Route::get('/facilities', [App\Http\Controllers\PublicFacilityController::class, 'index'])->name('facilities.index');
Route::get('/facilities/{facility}', [App\Http\Controllers\PublicFacilityController::class, 'show'])->name('facilities.show');
Route::get('/programs', [App\Http\Controllers\PublicProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program}', [App\Http\Controllers\PublicProgramController::class, 'show'])->name('programs.show');

// Sitemap
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);

// Static Pages (AdSense Compliance)
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('pages.about');
Route::get('/privacy', [App\Http\Controllers\PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/disclaimer', [App\Http\Controllers\PageController::class, 'disclaimer'])->name('pages.disclaimer');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
