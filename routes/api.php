<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QradarController;



// Here is where you can register API routes for your application. 
Route::get('/qradar-live-events', [QradarController::class, 'liveEvents']);

Route::get('/qradar-refresh', [QradarController::class, 'refreshData']);