<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Voting\VoteController;

Route::get('/login', [VoteController::class, 'login'])->name('login');
Route::post('/login', [VoteController::class, 'authenticate'])->name('authenticate');
Route::get('/ballot', [VoteController::class, 'ballot'])->name('ballot');
Route::post('/vote', [VoteController::class, 'store'])->name('store');
