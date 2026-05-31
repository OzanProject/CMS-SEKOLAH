<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\VotingController as AdminVotingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Article CMS
    Route::delete('articles/bulk-destroy', [ArticleController::class, 'bulkDestroy'])->name('articles.bulk_destroy');
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // PPDB Admin
    Route::get('ppdb/export-pdf', [AdminPpdbController::class, 'exportPdf'])->name('ppdb.exportPdf');
    Route::get('ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
    Route::get('ppdb/{registration}', [AdminPpdbController::class, 'show'])->name('ppdb.show');
    Route::put('ppdb/{registration}/status', [AdminPpdbController::class, 'updateStatus'])->name('ppdb.updateStatus');
    Route::delete('ppdb/{registration}', [AdminPpdbController::class, 'destroy'])->name('ppdb.destroy');

    // Voting Admin
    Route::resource('voting', AdminVotingController::class);
    // Route::post('voting/{event}/candidates', [AdminVotingController::class, 'storeCandidate'])->name('voting.candidates.store'); // Moved to candidate controller
    Route::post('voting/{event}/candidates', [App\Http\Controllers\Admin\VotingCandidateController::class, 'store'])->name('voting.candidates.store');

    // Candidate Resource (Nested somewhat via ID but direct resource)
    Route::resource('candidates', App\Http\Controllers\Admin\VotingCandidateController::class)->except(['index', 'create', 'store']);

    Route::post('voting/{event}/tokens', [AdminVotingController::class, 'generateTokens'])->name('voting.tokens.generate');
    Route::get('voting/{event}/tokens/export', [AdminVotingController::class, 'exportTokensPdf'])->name('voting.tokens.export');
    Route::delete('voting/{event}/tokens', [AdminVotingController::class, 'resetTokens'])->name('voting.tokens.reset');

    // Homepage Content
    Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class);
    Route::resource('facilities', App\Http\Controllers\Admin\FacilityController::class);
    Route::resource('facilities', App\Http\Controllers\Admin\FacilityController::class);
    // Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class); // Removed by User Request
    Route::resource('advertisements', App\Http\Controllers\Admin\AdvertisementController::class);
    Route::resource('advertisements', App\Http\Controllers\Admin\AdvertisementController::class);

    // Messages
    Route::resource('messages', App\Http\Controllers\Admin\MessageController::class)->only(['index', 'show', 'destroy']);

    // School Profile
    Route::get('school-profile', [App\Http\Controllers\Admin\SchoolProfileController::class, 'index'])->name('school_profile.index');
    Route::put('school-profile', [App\Http\Controllers\Admin\SchoolProfileController::class, 'update'])->name('school_profile.update');

    // Link / Layanan Digital
    Route::resource('links', App\Http\Controllers\Admin\LinkController::class);

    // Gallery
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);

    // Master Data
    // Master Data
    Route::delete('classrooms/bulk-destroy', [App\Http\Controllers\Admin\ClassroomController::class, 'bulkDestroy'])->name('classrooms.bulk_destroy');
    Route::resource('classrooms', App\Http\Controllers\Admin\ClassroomController::class)->except(['create', 'show', 'edit']);
    
    Route::get('students/template', [App\Http\Controllers\Admin\StudentController::class, 'downloadTemplate'])->name('students.template');
    Route::get('students', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students.index');
    Route::post('students/import', [App\Http\Controllers\Admin\StudentController::class, 'import'])->name('students.import');
    Route::delete('students/bulk-destroy', [App\Http\Controllers\Admin\StudentController::class, 'bulkDestroy'])->name('students.bulk_destroy');
    Route::delete('students/{student}', [App\Http\Controllers\Admin\StudentController::class, 'destroy'])->name('students.destroy');

    Route::delete('teachers/bulk-destroy', [App\Http\Controllers\Admin\TeacherController::class, 'bulkDestroy'])->name('teachers.bulk_destroy');
    Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class)->except(['create', 'show', 'edit']);
    Route::get('teachers/template', [App\Http\Controllers\Admin\TeacherController::class, 'downloadTemplate'])->name('teachers.template');
    Route::post('teachers/import', [App\Http\Controllers\Admin\TeacherController::class, 'import'])->name('teachers.import');

    Route::delete('committees/bulk-destroy', [App\Http\Controllers\Admin\CommitteeController::class, 'bulkDestroy'])->name('committees.bulk_destroy');
    Route::resource('committees', App\Http\Controllers\Admin\CommitteeController::class)->except(['create', 'show', 'edit']);
    Route::get('committees/template', [App\Http\Controllers\Admin\CommitteeController::class, 'downloadTemplate'])->name('committees.template');
    Route::post('committees/import', [App\Http\Controllers\Admin\CommitteeController::class, 'import'])->name('committees.import');

    // CKEditor Upload
    Route::post('upload', [App\Http\Controllers\Admin\UploadController::class, 'upload'])->name('upload');

});
