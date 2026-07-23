<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConteudoController;
use App\Http\Controllers\Api\TurismoController;
use App\Http\Controllers\Api\BuscaController;

Route::get('/home', [ConteudoController::class, 'home']);
Route::get('/noticias', [ConteudoController::class, 'index']);
Route::get('/noticias/{slug}', [ConteudoController::class, 'show']);
Route::get('/turismo', [TurismoController::class, 'index']);
Route::get('/eventos', [ConteudoController::class, 'eventos']);
Route::get('/busca', [BuscaController::class, 'search']);
