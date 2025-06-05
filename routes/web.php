<?php

use App\Http\Controllers\SearchController;
use App\Livewire\Dataset;
use App\Livewire\HomePage;
use App\Livewire\Organization;
use App\Livewire\Tentang;
use Illuminate\Support\Facades\Route;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomePage::class)->name('home');
// Route::get('/search', [SearchController::class, 'search'])->name('search');
// Rute dataset
// Rute dataset
Route::prefix('dataset')->group(function () {
    // Rute utama
    Route::get('/', [\App\Http\Controllers\DatasetController::class, 'index'])
        ->name('dataset.index');

    // Alias untuk kompatibilitas
    Route::get('', [\App\Http\Controllers\DatasetController::class, 'index'])
        ->name('dataset');

    // Rute untuk filter
    Route::get('organization/{organization}', [\App\Http\Controllers\DatasetController::class, 'byOrganization'])
        ->name('dataset.organization');

    Route::get('tag/{tag}', [\App\Http\Controllers\DatasetController::class, 'byTag'])
        ->name('dataset.tag');
});

// Rute lainnya
Route::get('/organization', Organization::class)->name('organisasi');
Route::get('/tentang', Tentang::class)->name('tentang');
