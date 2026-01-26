<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrafanaProxyController;
// DashboardController referenced by string in routes to avoid missing-type static error.



Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// مسارات 2FA (خارج middleware auth لأن المستخدم لم يسجل دخوله كاملاً بعد)
Route::get('/2fa-setup', [AuthController::class, 'show2faSetup'])->name('2fa.setup');
Route::post('/2fa-enable', [AuthController::class, 'enable2fa'])->name('2fa.enable');
Route::get('/2fa-verify', [AuthController::class, 'show2faForm'])->name('2fa.verify');
Route::post('/2fa-check', [AuthController::class, 'check2fa'])->name('2fa.check');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Route::get('/grafana', function () {
//     return view('grafana');
// })->middleware('auth')->name('grafana');;

Route::get('/app', function () {
    return view('app.home');
})->middleware('auth')->name('app.home');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard/create', 'App\Http\Controllers\DashboardController@create')
        ->name('dashboard.create');

    Route::get('/dashboard/{type}', 'App\Http\Controllers\DashboardController@show')
        ->name('dashboard.show');

    Route::post('/dashboard/save-custom', 'App\Http\Controllers\DashboardController@saveCustomLayout')
        ->name('dashboard.saveCustom');

    Route::get('/my-dashboard', 'App\Http\Controllers\DashboardController@myDashboard')
        ->name('dashboard.myDashboard');
        // عرض داشبورد محدد باستخدام الـ ID
    Route::get('/dashboard/view-custom/{id}', 'App\Http\Controllers\DashboardController@viewCustom')
        ->name('dashboard.viewCustom');
    Route::delete('/dashboard/delete/{id}', 'App\Http\Controllers\DashboardController@deleteDashboard')
        ->name('dashboard.delete');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])->name('support.support'); // هذا الاسم هو اللي غادي تستخدمه
    
});

