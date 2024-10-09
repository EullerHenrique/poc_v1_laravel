<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/series');
});

#Route::resource('series', SeriesController::class)->only(['index', 'create', 'store', 'destroy']);

Route::controller(SeriesController::class)->group(function(){
    Route::get('/series',  'index')->name('series.index');
    Route::get('/series/create', 'create')->name('series.create');
    Route::post('/series/save', 'store')->name('series.store');
    Route::delete('/series/{id}/destroy', 'destroy')->name('series.destroy');
});


