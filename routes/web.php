<?php

use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomePage::class)->name('home');
Route::get('/search', [SearchController::class, 'search'])->name('search');