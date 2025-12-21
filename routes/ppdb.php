<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ppdb\RegistrationController;

Route::get('/', [RegistrationController::class, 'index'])->name('index');
Route::get('/register', [RegistrationController::class, 'create'])->name('create');
Route::post('/register', [RegistrationController::class, 'store'])->name('store');
Route::get('/success/{registration}', [RegistrationController::class, 'success'])->name('success');

Route::get('/check-status', [RegistrationController::class, 'checkStatus'])->name('check-status');
Route::post('/check-status', [RegistrationController::class, 'searchStatus'])->name('search-status');
