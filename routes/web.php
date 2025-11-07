<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Show the Poll and Voting Form
Route::get('/poll/{poll}', [PollController::class, 'show'])->name('poll.show');

// Handle the Vote Submission
Route::post('/poll/{poll}/vote', [PollController::class, 'vote'])->name('poll.vote');

// Show the Results
Route::get('/poll/{poll}/results', [PollController::class, 'results'])->name('poll.results');

