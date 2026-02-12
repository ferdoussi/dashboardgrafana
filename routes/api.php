<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QradarController;



// الرابط اللي غيستعملو Grafana
Route::get('/qradar-live-events', [QradarController::class, 'liveEvents']);

// الرابط اللي غتستعملو أنت في Postman باش "تفرصي" التحديث
Route::get('/qradar-refresh', [QradarController::class, 'refreshData']);