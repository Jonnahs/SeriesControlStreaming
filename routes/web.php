<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use App\Http\Controllers\EpisodiosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series',[SeriesController::class, 'index'])->name('listar_series');
Route::get('/series/criar',[SeriesController::class, 'create'])->name('criar_serie');
Route::post('/series/criar',[SeriesController::class, 'store']);
Route::delete('/series/{id}',[SeriesController::class, 'destroy']);
Route::post('/series/{id}/editaNome', [SeriesController::class, 'edit']);

Route::get('/series/{serieId}/temporadas',[TemporadasController::class, 'index']);
Route::get('/temporadas/{temporada}/episodios',[EpisodiosController::class, 'index'])->name('listar_episodios');
Route::post('/temporadas/{temporada}/episodios/assistir',[EpisodiosController::class, 'assistir']);
