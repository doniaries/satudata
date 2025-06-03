<?php

use App\Http\Controllers\SearchController;
use App\Livewire\Dataset;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomePage::class)->name('home');
Route::get('/search', [SearchController::class, 'search'])->name('search');


Route::get('/dataset', Dataset::class)->name('dataset');
