<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/getAll', [NewsController::class, 'index'])->name('index');
Route::get('/getById/{id}', [NewsController::class, 'show'])->name('show');
