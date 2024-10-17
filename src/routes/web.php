<?php

use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController; 
use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/series');
})->middleware(Autenticador::class);

#Route::resource('series', SeriesController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update'])->except(['show']);;

Route::controller(SeriesController::class)->group(function(){
    Route::get('/series',  'index')->name('series.index');
    Route::get('/series/create', 'create')->name('series.create');
    Route::post('/series/save', 'store')->name('series.store');
    Route::delete('/series/{id}/destroy', 'destroy')->name('series.destroy');
    Route::get('/series/{id}/edit', 'edit')->name('series.edit');
    Route::put('/series/{id}/update', 'update')->name('series.update');
});

Route::get('/series/{id}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

Route::get('/seasons/{id}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');

Route::post('/seasons/{id}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
