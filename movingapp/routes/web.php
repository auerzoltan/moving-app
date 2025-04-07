// routes/web.php
<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('boxes', BoxController::class);


Route::resource('objects', ObjectController::class);


Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');


Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');