<?php

use App\Http\Controllers\ProlosaursController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProlosaursController::class, 'showForm'])
    ->name('prolosaurs.form');
Route::post('/prolosaurs/calculate', [ProlosaursController::class, 'calculateProtectedArea'])
    ->name('prolosaurs.calculate');

