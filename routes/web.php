<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PublicEstablishmentSearch;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/lookup', PublicEstablishmentSearch::class)->name('public.lookup');
