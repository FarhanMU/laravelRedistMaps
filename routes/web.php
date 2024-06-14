<?php

use App\Http\Controllers\RedistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RedistController::class, 'index']);
Route::get('/search-location', [RedistController::class, 'searchLocation']);
